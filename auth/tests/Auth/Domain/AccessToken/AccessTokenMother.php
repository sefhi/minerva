<?php

declare(strict_types=1);

namespace Tests\Auth\Domain\AccessToken;

use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\AccessToken\CryptKeyPrivate;
use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\AccessToken\TokeType;
use Auth\Domain\RefreshToken\RefreshToken;
use Auth\Domain\Token\Token;
use DateTimeImmutable;

final class AccessTokenMother
{

    public static function create(
        TokeType $tokeType,
        DateTimeImmutable $expiresIn,
        string $token,
        ?string $refreshToken = null,
    ): AccessToken {
        return AccessToken::create($tokeType, $expiresIn, $token);
    }

    public static function createWithRefreshToken(
        Token $token,
        RefreshToken $refreshToken,
        GenerateToken $generateToken
    ): AccessToken {
        //TODO cripkey tiene que estar  inyectadonse desde infra
        $key = CryptKeyPrivate::create(getenv('OAUTH_PRIVATE_KEY'));
        return $generateToken->generateAccessToken($key, $token, $refreshToken);
    }


}