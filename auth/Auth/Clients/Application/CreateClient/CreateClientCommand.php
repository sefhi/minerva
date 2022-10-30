<?php

declare(strict_types=1);

namespace Auth\Clients\Application\CreateClient;

use Auth\Clients\Domain\Client\ClientGrants;
use Auth\Clients\Domain\Client\ClientName;
use Auth\Clients\Domain\Client\ClientRedirectUris;
use Auth\Clients\Domain\Client\ClientScopes;

final class CreateClientCommand
{

    private function __construct(
        private readonly ClientName $name,
        private readonly array $grants,
        private readonly ?ClientRedirectUris $redirectUris = null,
        private readonly ?ClientScopes $scopes = null,
        private readonly bool $active = true,
    ) {
    }

    public static function create(
        ClientName $name,
        array $grants,
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

    public function getGrants(): array
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
