<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Exception;
use Minerva\Posts\Application\FindAllPostQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostsFindAllGetController extends AbstractController
{
    public function __construct(private FindAllPostQueryHandler $queryHandler)
    {
    }

    #[Route('/posts/all', name: 'posts_find_all', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        try {
            $result = ($this->queryHandler)();

            return $this->json(['data' => $result->getPosts()], Response::HTTP_OK);
        } catch (Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
