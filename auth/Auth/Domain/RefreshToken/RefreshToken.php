<?php

declare(strict_types=1);

namespace Auth\Domain\RefreshToken;

use Auth\Domain\Token\Token;
use Auth\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\UuidInterface;

final class RefreshToken extends AggregateRoot
{
    public const TTL = 'P1M';

    public function __construct(
        private UuidInterface $id,
        private readonly Token $token,
        private \DateTimeImmutable $expiry,
        private bool $revoked,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Token $token,
        bool $revoked,
    ): self {
        $expiry = new \DateTimeImmutable();
        $expiry = $expiry->add(new \DateInterval(self::TTL));

        return new self($id, $token, $expiry, $revoked);
    }

    public function getToken(): Token
    {
        return $this->token;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getExpiry(): \DateTimeImmutable
    {
        return $this->expiry;
    }

    public function isRevoked(): bool
    {
        return $this->revoked;
    }

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
