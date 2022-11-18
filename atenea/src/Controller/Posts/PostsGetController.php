<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Atenea\Posts\Application\SearchByCriteria\SearchPostsByCriteriaQuery;
use Atenea\Posts\Application\SearchByCriteria\SearchPostsByCriteriaQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $filters = (array)$request->query->get('filters');

        $query = SearchPostsByCriteriaQuery::create($filters, $orderBy, $order, $limit, $offset);

        $result = ($this->queryHandler)($query);

        return new JsonResponse('', Response::HTTP_OK);
    }
}
