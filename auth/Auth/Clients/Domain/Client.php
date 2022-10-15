<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

use Ramsey\Uuid\UuidInterface;

final class Client
{
    public function __construct(
        private UuidInterface $id,
        private ClientCredentialsParam $credentials,
        private ?ClientRedirectUris $redirectUris = null,
        private ?ClientGrants $grants = null,
        private ?ClientScopes $scopes = null,
        private bool $active = true,
    )
    {
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return ClientCredentialsParam
     */
    public function getCredentials(): ClientCredentialsParam
    {
        return $this->credentials;
    }

    /**
     * @return ClientRedirectUris|null
     */
    public function getRedirectUris(): ?ClientRedirectUris
    {
        return $this->redirectUris;
    }

    /**
     * @return ClientGrants|null
     */
    public function getGrants(): ?ClientGrants
    {
        return $this->grants;
    }

    /**
     * @return ClientScopes|null
     */
    public function getScopes(): ?ClientScopes
    {
        return $this->scopes;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }


}