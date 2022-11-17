<?php

declare(strict_types=1);

namespace Auth\Domain\Token;

use Ramsey\Uuid\UuidInterface;

interface TokenFindRepository
{
    public function find(UuidInterface $id): ?Token;

    /**
     * @throw class NotFoundException
     */
    public function findOrFail(UuidInterface $id): Token;
}
