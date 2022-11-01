<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Symfony\Security;

use Auth\Clients\Domain\AccessToken\CryptKeyPublic;
use Auth\Clients\Domain\AccessToken\GenerateToken;
use Auth\Clients\Domain\Bearer\TokenBearer;
use Exception;
use League\Bundle\OAuth2ServerBundle\Security\Passport\Badge\ScopeBadge;
use League\Bundle\OAuth2ServerBundle\Security\User\NullUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

final class BearerTokenAuthenticator extends AbstractAuthenticator
{


    public function __construct(
        private readonly GenerateToken $generateToken,
        private readonly UserProviderInterface $userProvider,
    )
    {
    }

    public function supports(Request $request): ?bool
    {
        return str_starts_with($request->headers->get('Authorization', ''), 'Bearer ');
    }

    /**
     * @throws Exception
     */
    public function authenticate(Request $request): Passport
    {
        if (false === $request->headers->has('Authorization')) {
//            throw OAuthServerException::accessDenied('Missing "Authorization" header'); //TODO
            throw new Exception('Missing "Authorization" header');
        }

        $token = $this->generateToken->generateTokenByBearer(
            CryptKeyPublic::create(getenv('OAUTH_PUBLIC_KEY')),
            new TokenBearer($request->headers->get('Authorization')),
        );
        $userIdentifier = $token->getUser()?->getUserIdentifier() ?? '';
        $userLoaderCallback = function (string $userIdentifier): UserInterface {
            if ('' === $userIdentifier) {
                return new NullUser();
            }
            return $this->userProvider->loadUserByIdentifier($userIdentifier);
        };

        $passport = new SelfValidatingPassport(
            new UserBadge($userIdentifier, $userLoaderCallback),
            [new ScopeBadge($token->getScopes())]
        );

        $passport->setAttribute('token', $token);

        return $passport;

    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        if ($exception instanceof Exception) {
            return new Response($exception->getMessage(), $exception->getStatusCode(), $exception->getHeaders());
        }

        throw $exception;
    }
}