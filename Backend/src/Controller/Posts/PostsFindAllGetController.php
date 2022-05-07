<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostsFindAllGetController extends AbstractController
{
    #[Route('/post/all', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return $this->json(['data' => 'ok'], Response::HTTP_OK);
    }
}
