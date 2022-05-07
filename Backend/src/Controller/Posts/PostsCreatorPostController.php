<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostsCreatorPostController extends AbstractController
{
    #[Route('/post', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        return $this->json('', Response::HTTP_OK);
    }
}
