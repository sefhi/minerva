<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Controller\Auth\Dto\AccessTokenDto;
use Auth\Application\Token\GenerateTokenCommand;
use Auth\Application\Token\GenerateTokenCommandHandler;
use Auth\Domain\Client\ClientIdentifier;
use Auth\Domain\Client\ClientSecret;
use Auth\Domain\Client\Grant;
use Auth\Domain\User\Email;
use Auth\Domain\User\Password;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GenerateTokenPostController extends AbstractController
{

    public function __construct(
        private readonly GenerateTokenCommandHandler $commandHandler
    )
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/auth/token', name: 'auth_token', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        [$clientId, $secret, $grantType, $username, $password, $refreshToken] = $this->getClientCredentials($request);

        $accessToken = ($this->commandHandler)(GenerateTokenCommand::create(
            ClientIdentifier::fromString($clientId),
            ClientSecret::fromString($secret),
            Grant::from($grantType),
            getenv('OAUTH_PRIVATE_KEY'),
            getenv('OAUTH_PUBLIC_KEY'),
            null === $username ? $username : Email::fromString($username),
            null === $password ? $password : Password::fromString($password),
            $refreshToken
        ));

        return $this->json(AccessTokenDto::fromDomain($accessToken), Response::HTTP_OK);
    }

    private function getClientCredentials(Request $request): array
    {
        $clientId = $request->get('client_id');
        $secret = $request->get('client_secret');
        $grantType = $request->get('grant_type');
        $username = $request->get('username');
        $password = $request->get('password');
        $refreshToken = $request->get('refresh_token');

        return [$clientId, $secret, $grantType, $username, $password, $refreshToken];
    }

}
