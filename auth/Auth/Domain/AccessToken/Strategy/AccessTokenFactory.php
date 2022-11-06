<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken\Strategy;

use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\Client\Grant;
use Auth\Domain\RefreshToken\RefreshTokenFindRepository;
use Auth\Domain\RefreshToken\RefreshTokenSaveRepository;
use Auth\Domain\Token\TokenSaveRepository;
use Auth\Domain\User\PasswordHasher;
use Auth\Domain\User\UserFindRepository;
use Exception;

final class AccessTokenFactory
{

    public function __construct(
        private readonly UserFindRepository $userFindRepository,
        private readonly PasswordHasher $passwordHasher,
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly GenerateToken $generateToken,
        private readonly RefreshTokenFindRepository $refreshTokenFindRepository,
        private readonly RefreshTokenSaveRepository $refreshTokenSaveRepository,
    ) {
    }

    /**
     * @throws Exception
     */
    public function getAccessTokenMethod(Grant $grant): AccessTokenMethod
    {
        return match ($grant) {
            Grant::CLIENT_CREDENTIALS => new ClientCredentialsAccessToken(
                $this->tokenSaveRepository,
                $this->generateToken
            ),
            Grant::PASSWORD => new PasswordAccessToken(
                $this->tokenSaveRepository,
                $this->generateToken,
                $this->userFindRepository,
                $this->passwordHasher,
                $this->refreshTokenFindRepository,
                $this->refreshTokenSaveRepository
            ),
            Grant::REFRESH_TOKEN => new RefreshAccessToken(),
            default => throw new Exception('Unknown Grant Type'),
        };
    }
}