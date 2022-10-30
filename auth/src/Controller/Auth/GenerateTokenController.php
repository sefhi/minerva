<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Controller\Auth\Dto\AccessTokenDto;
use App\Entity\AuthToken;
use Auth\Clients\Application\GenerateToken\GenerateTokenCommand;
use Auth\Clients\Application\GenerateToken\GenerateTokenCommandHandler;
use Auth\Clients\Domain\AccessToken\CryptKeyPrivate;
use Auth\Clients\Domain\Client\ClientIdentifier;
use Auth\Clients\Domain\Client\ClientSecret;
use Auth\Clients\Domain\Client\Grant;
use Auth\Clients\Domain\Token\Token;
use Exception;
use League\OAuth2\Server\Exception\OAuthServerException;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GenerateTokenController extends AbstractController
{

    public function __construct(
        private readonly GenerateTokenCommandHandler $commandHandler
    )
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/auth/token')]
    public function __invoke(Request $request): JsonResponse
    {
        //1º validar request client
        [$clientId, $secret, $grantType] = $this->getClientCredentials($request);

        $accessToken = ($this->commandHandler)(GenerateTokenCommand::create(
            ClientIdentifier::fromString($clientId),
            ClientSecret::fromString($secret),
            Grant::from($grantType),
            getenv('OAUTH_PRIVATE_KEY'),
            getenv('OAUTH_PUBLIC_KEY'),
        ));

        return $this->json(AccessTokenDto::fromDomain($accessToken), Response::HTTP_OK);
    }

    private function getClientCredentials(Request $request): array
    {
        $clientId = $request->get('client_id');
        $secret = $request->get('secret');
        $grantType = $request->get('grant_type');

        return [$clientId, $secret, $grantType];
    }

}
