<?php

namespace Auth\Domain\Token;

use Auth\Domain\Client\Client;
use Ramsey\Uuid\UuidInterface;

interface TokenInterface
{
    public function getId(): UuidInterface;

    public function getClient(): Client;

    public function getExpiry(): \DateTimeImmutable;

    public function getScopes(): array;

    public function isRevoked(): bool;

    public function getUser(): ?string;
}
