<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use App\Tests\Controller\BaseController;
use Atenea\Posts\Application\SearchAll\FindAllPostQueryHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostsFindAllGetController extends BaseController
{
    public function __construct(
        private readonly FindAllPostQueryHandler $queryHandler,
    ) {
    }

    #[Route('/posts/all', name: 'posts_find_all', methods: ['GET'])]
    public function __invoke(EntityManagerInterface $entityManager): JsonResponse
    {
        $result = ($this->queryHandler)();

        return $this->json(['data' => $result->getPosts()], Response::HTTP_OK);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
