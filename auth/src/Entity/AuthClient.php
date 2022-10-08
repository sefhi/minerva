<?php

namespace App\Entity;

use App\Repository\AuthClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: AuthClientRepository::class)]
class AuthClient
{
    #[ORM\Id, ORM\Column(type: 'uuid', unique: true)]
    private UuidInterface $id;

    #[ORM\Column(length: 32)]
    private string $identifier;

    #[ORM\Column(length: 128)]
    private string $name;

    #[ORM\Column(length: 128)]
    private string $secret;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $redirectUris = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $grants = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $scopes = null;

    #[ORM\Column]
    private bool $active;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    public function getRedirectUris(): ?string
    {
        return $this->redirectUris;
    }

    public function setRedirectUris(string $redirectUris): self
    {
        $this->redirectUris = $redirectUris;

        return $this;
    }

    public function getGrants(): ?string
    {
        return $this->grants;
    }

    public function setGrants(string $grants): self
    {
        $this->grants = $grants;

        return $this;
    }

    public function getScopes(): ?string
    {
        return $this->scopes;
    }

    public function setScopes(?string $scopes): self
    {
        $this->scopes = $scopes;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
