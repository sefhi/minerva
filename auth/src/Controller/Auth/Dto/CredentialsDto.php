<?php

declare(strict_types=1);

namespace App\Controller\Auth\Dto;

use Auth\Domain\Client\ClientCredentialsParam;
use JsonSerializable;

final class CredentialsDto implements JsonSerializable
{

    public function __construct(
        private readonly string $clientIdentifier,
        private readonly string $name,
        private readonly string $clientSecret,
    )
    {
    }

    public static function fromClientCredentials(ClientCredentialsParam $clientCredentialsParam): self {
        return new self(
            (string)$clientCredentialsParam->getIdentifier(),
            (string)$clientCredentialsParam->getName(),
            (string)$clientCredentialsParam->getSecret()
        );
    }

    /**
     * @return string
     */
    public function getClientIdentifier(): string
    {
        return $this->clientIdentifier;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}