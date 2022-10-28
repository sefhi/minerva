<?php

namespace App\Entity;

use App\Repository\AuthTokenRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthTokenRepository::class)]
class AuthToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $expiryAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $userId = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $scopes = null;

    #[ORM\Column]
    private ?bool $revoked = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AuthClient $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpiryAt(): ?\DateTimeImmutable
    {
        return $this->expiryAt;
    }

    public function setExpiryAt(\DateTimeImmutable $expiryAt): self
    {
        $this->expiryAt = $expiryAt;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

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

    public function isRevoked(): ?bool
    {
        return $this->revoked;
    }

    public function setRevoked(bool $revoked): self
    {
        $this->revoked = $revoked;

        return $this;
    }

    public function getClient(): ?AuthClient
    {
        return $this->client;
    }

    public function setClient(?AuthClient $client): self
    {
        $this->client = $client;

        return $this;
    }
}
