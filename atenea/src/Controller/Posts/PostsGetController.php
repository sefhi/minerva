<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use App\Controller\Posts\Dto\PostAuthorResponse;
use App\Controller\Posts\Dto\PostResponse;
use Atenea\Posts\Application\SearchByCriteria\SearchPostsByCriteriaQuery;
use Atenea\Posts\Application\SearchByCriteria\SearchPostsByCriteriaQueryHandler;
use Atenea\Posts\Domain\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function Lambdish\Phunctional\map;

final class PostsGetController extends AbstractController
{
    public function __construct(private readonly SearchPostsByCriteriaQueryHandler $queryHandler)
    {
    }

    #[Route('/posts', name: 'posts_search', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $orderBy = $request->get('order_by');
        $order = $request->get('order');
        $limit = $request->get('limit');
        $offset = $request->get('offset');
        $filters = $request->query->all('filters');

        $query = SearchPostsByCriteriaQuery::create(
            $filters,
            null === $orderBy ? null : (string) $orderBy,
            null === $order ? null : (string) $order,
            null === $limit ? null : (int) $limit,
            null === $offset ? null : (int) $offset,
        );

        $result = ($this->queryHandler)($query);

        return new JsonResponse(
            map(
                static fn (Post $post) => PostResponse::create(
                    (string) $post->getId(),
                    (string) $post->getTitle(),
                    (string) $post->getContent(),
                    PostAuthorResponse::create(
                        (string) $post->getAuthor()->getId(),
                        (string) $post->getAuthor()->getName(),
                        (string) $post->getAuthor()->getUsername(),
                        (string) $post->getAuthor()->getWebsite(),
                        (string) $post->getAuthor()->getEmail(),
                    )
                ),
                $result
            ),
            Response::HTTP_OK,
        );
    }
}
