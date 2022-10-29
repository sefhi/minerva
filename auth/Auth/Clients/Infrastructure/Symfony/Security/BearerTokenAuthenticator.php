<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Symfony\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

final class BearerTokenAuthenticator implements AuthenticatorInterface
{

    public function supports(Request $request): ?bool
    {
        return str_starts_with($request->headers->get('Authorization', ''), 'Bearer ');
    }

    public function authenticate(Request $request): Passport
    {
        // TODO: Implement authenticate() method.
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