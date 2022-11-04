<?php

declare(strict_types=1);

namespace Auth\Domain\Client;

use Auth\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Client extends AggregateRoot
{
    private function __construct(
        private readonly UuidInterface $id,
        private readonly ClientCredentialsParam $credentials,
        private readonly ?ClientRedirectUris $redirectUris = null,
        private readonly ?array $grants = null,
        private readonly ?ClientScopes $scopes = null,
        private readonly bool $active = true,
    ) {
    }

    public static function create(
        UuidInterface $id,
        ClientCredentialsParam $credentials,
        ?ClientRedirectUris $redirectUris = null,
        ?array $grants = null,
        ?ClientScopes $scopes = null,
        bool $active = true,
    ): self {
        return new self(
            $id,
            $credentials,
            $redirectUris,
            $grants,
            $scopes,
            $active
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCredentials(): ClientCredentialsParam
    {
        return $this->credentials;
    }

    public function getRedirectUris(): ?ClientRedirectUris
    {
        return $this->redirectUris;
    }

    public function getGrants(): ?array
    {
        return $this->grants;
    }

    public function getScopes(): ?ClientScopes
    {
        return $this->scopes;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isGrantSupported(Client $client, ?string $grant): bool
    {
        if (null === $grant) {
            return true;
        }

        $grants = $client->getGrants();

        if (empty($grants)) {
            return true;
        }

        return in_array($grant, $client->getGrants(), true);
    }

}