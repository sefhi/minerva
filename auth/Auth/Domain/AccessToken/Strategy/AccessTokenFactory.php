<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken\Strategy;

use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\Client\Grant;
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
    ) {
    }

    /**
     * @throws Exception
     */
    public function getAccessTokenMethod(Grant $grant): AccessTokenMethod
    {
        switch ($grant) {
            case Grant::CLIENT_CREDENTIALS:
                return new ClientCredentialsAccessToken($this->tokenSaveRepository, $this->generateToken);
            case Grant::PASSWORD:
                return new PasswordAccessToken(
                    $this->tokenSaveRepository,
                    $this->generateToken,
                    $this->userFindRepository,
                    $this->passwordHasher
                );
            case Grant::REFRESH_TOKEN:
                throw new Exception('To be implemented');
            default:
                throw new Exception('Unknown Grant Type');
        }
    }
}