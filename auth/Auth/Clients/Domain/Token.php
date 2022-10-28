<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

use Auth\Shared\Domain\Aggregate\AggregateRoot;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

final class Token extends AggregateRoot
{

    private function __construct(
        private UuidInterface $id,
        private Client $client,
        private readonly DateTimeImmutable $expiry,
        private bool $revoked,
        private ?TokenScope $scopes = null,
        private ?string $user = null,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Client $client,
        DateTimeImmutable $expiry,
        bool $revoked,
        ?TokenScope $scopes = null,
        ?string $user = null,
    ): self {
        return new self(
            $id,
            $client,
            $expiry,
            $revoked,
            $scopes,
            $user
        );
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
