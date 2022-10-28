<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

final class Token
{

    public function __construct(
        private UuidInterface $id,
        private Client $client,
        private DateTimeImmutable $expiry,
        private TokenScope $scopes,
        private bool $revoked,
        private ?string $user = null,
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
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getExpiry(): DateTimeImmutable
    {
        return $this->expiry;
    }

    /**
     * @return TokenScope
     */
    public function getScopes(): TokenScope
    {
        return $this->scopes;
    }

    /**
     * @return bool
     */
    public function isRevoked(): bool
    {
        return $this->revoked;
    }

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

}
