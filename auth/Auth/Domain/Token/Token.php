<?php

declare(strict_types=1);

namespace Auth\Domain\Token;

use Auth\Domain\Client\Client;
use Auth\Domain\User\User;
use Auth\Domain\User\UserInterface;
use Auth\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\UuidInterface;

final class Token extends AggregateRoot
{
    public const TTL = 'PT2H';

    public function __construct(
        private UuidInterface $id,
        private readonly Client $client,
        private \DateTimeImmutable $expiry,
        private bool $revoked,
        private readonly array $scopes = [],
        private readonly ?User $user = null,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Client $client,
        bool $revoked,
        array $scopes = [],
        ?User $user = null,
    ): self {
        $expiry = new \DateTimeImmutable();
        $expiry = $expiry->add(new \DateInterval(self::TTL));

        return new self(
            $id,
            $client,
            $expiry,
            $revoked,
            $scopes,
            $user
        );
    }

    public static function createWithUser(
        UuidInterface $id,
        Client $client,
        User $user,
        bool $revoked,
        array $scopes = [],
    ): self {
        $expiry = new \DateTimeImmutable();
        $expiry = $expiry->add(new \DateInterval(self::TTL));

        return new self(
            $id,
            $client,
            $expiry,
            $revoked,
            $scopes,
            $user
        );
    }

    public function setExpiry(\DateTimeImmutable $expiry): void
    {
        $this->expiry = $expiry->add(new \DateInterval(self::TTL));
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getExpiry(): \DateTimeImmutable
    {
        return $this->expiry;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function isRevoked(): bool
    {
        return $this->revoked;
    }

    /**
     * @return UserInterface|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function revoke(): self
    {
        $this->revoked = true;

        return $this;
    }
}
