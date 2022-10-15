<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

final class ClientCredentialsParam
{

    public function __construct(
        private ClientIdentifier $identifier,
        private ClientName $name,
        private ClientSecret $secret
    )
    {
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
