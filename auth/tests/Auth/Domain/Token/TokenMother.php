<?php

namespace Tests\Auth\Domain\Token;

use Auth\Domain\Client\Client;
use Auth\Domain\Token\Token;
use Auth\Domain\User\User;
use Ramsey\Uuid\UuidInterface;
use Tests\Auth\Domain\Client\ClientMother;
use Tests\Auth\Domain\User\UserMother;
use Tests\Auth\Shared\Domain\MotherFactory;
use Tests\Auth\Shared\Domain\UuidMother;

class TokenMother
{
    public static function create(
        UuidInterface $id,
        Client $client,
        bool $revoked,
        array $scopes = [],
        ?User $user = null,
    ): Token {
        return Token::create(
            $id,
            $client,
            $revoked,
            $scopes,
            $user
        );
    }

    public static function createWithUser(
        UuidInterface $id,
        Client $client,
        \DateTimeImmutable $expiry,
        bool $revoked,
        User $user,
        array $scopes = [],
    ): Token {
        return Token::createWithUser(
            $id,
            $client,
            $user,
            $revoked,
            $scopes,
        );
    }

    public static function random(): Token
    {
        return self::create(
            UuidMother::random(),
            ClientMother::random(),
            MotherFactory::random()->randomElement([true, false]),
            [],
        );
    }

    public static function randomWithUser(): Token
    {
        return self::create(
            UuidMother::random(),
            ClientMother::random(),
            MotherFactory::random()->randomElement([true, false]),
            [],
            UserMother::random()
        );
    }
}
