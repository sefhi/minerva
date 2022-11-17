<?php

declare(strict_types=1);

namespace App\Controller\Auth\Dto;

use Auth\Domain\Client\ClientCredentialsParam;

final class CredentialsDto implements \JsonSerializable
{
    public function __construct(
        private readonly string $clientIdentifier,
        private readonly string $name,
        private readonly string $clientSecret,
    ) {
    }

    public static function fromClientCredentials(ClientCredentialsParam $clientCredentialsParam): self
    {
        return new self(
            (string) $clientCredentialsParam->getIdentifier(),
            (string) $clientCredentialsParam->getName(),
            (string) $clientCredentialsParam->getSecret()
        );
    }

    public function getClientIdentifier(): string
    {
        return $this->clientIdentifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
