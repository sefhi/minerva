<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

use Auth\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Client extends AggregateRoot
{
    private function __construct(
        private readonly UuidInterface $id,
        private ClientCredentialsParam $credentials,
        private ?ClientRedirectUris $redirectUris = null,
        private ?ClientGrants $grants = null,
        private ?ClientScopes $scopes = null,
        private bool $active = true,
    ) {
    }

    public static function create(
        ClientCredentialsParam $credentials,
        ?ClientRedirectUris $redirectUris = null,
        ?ClientGrants $grants = null,
        ?ClientScopes $scopes = null,
        bool $active = true,
    ): self {
        return new self(
            Uuid::uuid4(),
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

    public function getGrants(): ?ClientGrants
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

}