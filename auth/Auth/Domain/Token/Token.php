<?php

declare(strict_types=1);

namespace Auth\Domain\Token;

use Auth\Domain\Client\Client;
use Auth\Domain\User\User;
use Auth\Domain\User\UserInterface;
use Auth\Shared\Domain\Aggregate\AggregateRoot;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

final class Token extends AggregateRoot
{

    public function __construct(
        private readonly UuidInterface $id,
        private readonly Client $client,
        private readonly DateTimeImmutable $expiry,
        private bool $revoked,
        private readonly array $scopes = [],
        private readonly ?User $user = null,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Client $client,
        DateTimeImmutable $expiry,
        bool $revoked,
        array $scopes = [],
        ?User $user = null,
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

    public static function createWithUser(
        UuidInterface $id,
        Client $client,
        DateTimeImmutable $expiry,
        User $user,
        bool $revoked,
        array $scopes = [],
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
     * @return array
     */
    public function getScopes(): array
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
     * @return UserInterface|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function revoke(): self {

        $this->revoked = true;

        return $this;
    }

}
