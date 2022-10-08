<?php

declare(strict_types=1);

namespace App\Controller;

use League\OAuth2\Server\AuthorizationServer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class TokenController extends AbstractController
{

    public function __construct()
    {
    }

    #[Route('/auth/token')]
    public function __invoke(): JsonResponse
    {
        return $this->json('Hola');
    }
}