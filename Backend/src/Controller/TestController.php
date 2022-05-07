<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TestController extends AbstractController
{
    #[Route('/test', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return $this->json(['data' => 'ok'], Response::HTTP_OK);
    }
}
