<?php

declare(strict_types=1);

namespace Tests\Auth\Domain\Client;

use Auth\Domain\Client\ClientCredentialsParam;
use Auth\Domain\Client\ClientIdentifier;
use Auth\Domain\Client\ClientName;
use Auth\Domain\Client\ClientSecret;
use Tests\Auth\Shared\Domain\MotherFactory;

final class ClientCredentialsParamMother
{
    public static function create(
        ClientIdentifier $identifier,
        ClientName $name,
        ClientSecret $secret,
    ): ClientCredentialsParam {
        return ClientCredentialsParam::create(
            $identifier,
            $name,
            $secret,
        );
    }

    /**
     * @throws \Exception
     */
    public static function random(): ClientCredentialsParam
    {
        return self::create(
            ClientIdentifier::generate(),
            ClientName::fromString(MotherFactory::random()->company()),
            ClientSecret::generate()
        );
    }
}
