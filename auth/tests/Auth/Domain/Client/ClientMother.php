<?php

declare(strict_types=1);

namespace Tests\Auth\Domain\Client;

use Auth\Domain\Client\Client;
use Auth\Domain\Client\ClientCredentialsParam;
use Auth\Domain\Client\ClientRedirectUris;
use Auth\Domain\Client\ClientScopes;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Tests\Auth\Shared\Domain\MotherFactory;
use Tests\Auth\Shared\Domain\UuidMother;

final class ClientMother
{
    public static function create(
        UuidInterface $id,
        ClientCredentialsParam $credentials,
        ?ClientRedirectUris $redirectUris = null,
        ?array $grants = null,
        ?ClientScopes $scopes = null,
        bool $active = true,
    ): Client {
        return Client::create(
            $id,
            $credentials,
            $redirectUris,
            $grants,
            $scopes,
            $active
        );
    }

    /**
     * @throws Exception
     */
    public static function random(): Client
    {
        return self::create(
            UuidMother::random(),
            ClientCredentialsParamMother::random(),
            null,
            MotherFactory::random()->randomElements(['client_credentials', 'password']),
            null,
        );
    }
}