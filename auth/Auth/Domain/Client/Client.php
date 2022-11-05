<?php

declare(strict_types=1);

namespace Auth\Domain\Client;

use Auth\Domain\Client\Exception\ClientOperationDeniedException;
use Auth\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Client extends AggregateRoot
{
    public function __construct(
        private UuidInterface $id,
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

    public function getIdentifier(): ClientIdentifier
    {
        return $this->getCredentials()->getIdentifier();
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

    public function ensureIsActive(): bool
    {
        if (!$this->isActive()) {
            throw ClientOperationDeniedException::inactive($this->getIdentifier());
        }

        return true;
    }

    public function ensureGrantSupported(Grant $grant): bool
    {

        if (!$this->isGrantSupported($grant)) {
            throw ClientOperationDeniedException::grantNotSupported($this->getIdentifier(), $grant);
        }

        return true;
    }

    public function isGrantSupported(Grant $grant): bool
    {
        $grants = $this->getGrants();

        if (empty($grants)) {
            return false;
        }

        return in_array($grant->value, $grants, true);
    }

}
