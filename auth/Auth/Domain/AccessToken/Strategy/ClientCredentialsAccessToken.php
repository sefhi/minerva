<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken\Strategy;

use Auth\Application\Token\GenerateTokenCommand;
use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\Client\Client;
use Auth\Domain\Token\Token;
use Auth\Domain\Token\TokenSaveRepository;
use Ramsey\Uuid\Uuid;

final class ClientCredentialsAccessToken implements AccessTokenMethod
{

    public function __construct(
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly GenerateToken $generateToken,
    )
    {
    }

    public function generateAccessToken(GenerateTokenCommand $command, Client $client): AccessToken
    {
        $token = Token::create(
            Uuid::uuid4(),
            $client,
            false
        );

        $this->tokenSaveRepository->save($token);

        return $this->generateToken->generateAccessToken(
            $token,
            null
        );
    }
}