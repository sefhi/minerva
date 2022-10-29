<?php

declare(strict_types=1);

namespace Auth\Clients\Application\CreateClient;

use Auth\Clients\Domain\ClientGrants;
use Auth\Clients\Domain\ClientName;
use Auth\Clients\Domain\ClientRedirectUris;
use Auth\Clients\Domain\ClientScopes;

final class CreateClientCommand
{

    private function __construct(
        private ClientName $name,
        private ClientGrants $grants,
        private ?ClientRedirectUris $redirectUris = null,
        private ?ClientScopes $scopes = null,
        private bool $active = true,
    ) {
    }

    public static function create(
        ClientName $name,
        ClientGrants $grants,
        ?ClientRedirectUris $redirectUris = null,
        ?ClientScopes $scopes = null,
        bool $active = true,
    ): self {
        return new self($name, $grants, $redirectUris, $scopes, $active);
    }

    public function getName(): ClientName
    {
        return $this->name;
    }

    public function getGrants(): ClientGrants
    {
        return $this->grants;
    }

    public function getRedirectUris(): ?ClientRedirectUris
    {
        return $this->redirectUris;
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
