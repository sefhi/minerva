<?php

declare(strict_types=1);

namespace App\Entity;

use League\OAuth2\Server\CryptKey;

final class AbstractGrant
{
    /**
     * @var ClientRepositoryInterface
     */
    protected $clientRepository;

    /**
     * @var AccessTokenRepositoryInterface
     */
    protected $accessTokenRepository;

    /**
     * @var RefreshTokenRepositoryInterface
     */
    protected $refreshTokenRepository;

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var DateInterval
     */
    protected $refreshTokenTTL;

    /**
     * @var CryptKey
     */
    protected $privateKey;

}