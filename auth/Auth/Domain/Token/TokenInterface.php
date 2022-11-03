<?php

namespace Auth\Domain\Token;

use Auth\Domain\Client\Client;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

interface TokenInterface
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return Client
     */
    public function getClient(): Client;

    /**
     * @return DateTimeImmutable
     */
    public function getExpiry(): DateTimeImmutable;

    /**
     * @return array
     */
    public function getScopes(): array;

    /**
     * @return bool
     */
    public function isRevoked(): bool;

    /**
     * @return string|null
     */
    public function getUser(): ?string;
}