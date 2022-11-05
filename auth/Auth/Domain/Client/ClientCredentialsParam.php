<?php

declare(strict_types=1);

namespace Auth\Domain\Client;

use Exception;

final class ClientCredentialsParam
{

    public function __construct(
        private readonly ClientIdentifier $identifier,
        private readonly ClientName $name,
        private readonly ClientSecret $secret,
    ) {
    }

    public static function create(
        ClientIdentifier $identifier,
        ClientName $name,
        ClientSecret $secret,
    ): self {
        return new self(
            $identifier,
            $name,
            $secret,
        );
    }

    /**
     * @throws Exception
     */
    public static function createByName(
        ClientName $name,
    ): self {
        return new self(
            ClientIdentifier::generate(),
            $name,
            ClientSecret::generate(),
        );
    }

    /**
     * @return ClientIdentifier
     */
    public function getIdentifier(): ClientIdentifier
    {
        return $this->identifier;
    }

    /**
     * @return ClientName
     */
    public function getName(): ClientName
    {
        return $this->name;
    }

    /**
     * @return ClientSecret
     */
    public function getSecret(): ClientSecret
    {
        return $this->secret;
    }


}
