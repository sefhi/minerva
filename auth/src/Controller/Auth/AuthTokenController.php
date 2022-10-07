<?php

declare(strict_types=1);

namespace Auth\Controller\Auth;

use League\OAuth2\Server\AuthorizationServer;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class AuthTokenController extends AbstractController
{


    public function __construct(
        private HttpFoundationFactoryInterface $httpFoundationFactory,
        private HttpMessageFactoryInterface $httpMessageFactory
    )
    {
    }

    #[Route('/auth/token')]
    public function __invoke() : JsonResponse
    {
        $encryptionKey = getenv('ENCRYPTION_KEY');
        $privateKeyPath = getenv('PRIVATE_KEY');

//        $this->server->respondToAccessTokenRequest();
        return $this->json('Hola');
    }
}