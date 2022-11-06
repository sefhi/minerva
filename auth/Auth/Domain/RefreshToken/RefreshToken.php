<?php

declare(strict_types=1);

namespace Auth\Domain\RefreshToken;

use Auth\Domain\Token\Token;
use Auth\Shared\Domain\Aggregate\AggregateRoot;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

final class RefreshToken extends AggregateRoot
{

    public function __construct(
        private UuidInterface $id,
        private readonly Token $token,
        private readonly DateTimeImmutable $expiry,
        private bool $revoked,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Token $token,
        DateTimeImmutable $expiry,
        bool $revoked,
    ): self {
        return new self($id, $token, $expiry, $revoked);
    }

    /**
     * @return Token
     */
    public function getToken(): Token
    {
        return $this->token;
    }


    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getExpiry(): DateTimeImmutable
    {
        return $this->expiry;
    }

    /**
     * @return bool
     */
    public function isRevoked(): bool
    {
        return $this->revoked;
    }

    /**
     * @return RefreshToken
     */
    public function revoke(): self
    {
        $this->revoked = true;

        return $this;
    }


    public function __toString(): string
    {
        return $this->getId()->toString();
    }
}