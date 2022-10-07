<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class Healthcheck extends AbstractController
{

    #[Route('/auth/healthcheck', methods: ['GET'])]
    public function __invoke() : JsonResponse
    {
        return $this->json(['status' => 'ok'], Response::HTTP_OK);
    }
}