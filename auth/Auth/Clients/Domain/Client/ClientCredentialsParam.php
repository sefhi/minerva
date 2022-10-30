<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\Client;

use Exception;

final class ClientCredentialsParam
{

    private function __construct(
        private ClientIdentifier $identifier,
        private ClientName $name,
        private ClientSecret $secret,
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
            new ClientIdentifier(hash('md5', random_bytes(16))),
            $name,
            new ClientSecret(hash('sha512', random_bytes(32))),
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
