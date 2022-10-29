<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Symfony\Security;

use Auth\Clients\Domain\AccessToken\CryptKeyPublic;
use Auth\Clients\Domain\AccessToken\GenerateToken;
use Auth\Clients\Domain\Bearer\TokenBearer;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

final class BearerTokenAuthenticator implements AuthenticatorInterface
{


    public function __construct(private GenerateToken $generateToken)
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
    }

    public function createToken(Passport $passport, string $firewallName): TokenInterface
    {
        // TODO: Implement createToken() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // TODO: Implement onAuthenticationFailure() method.
    }
}