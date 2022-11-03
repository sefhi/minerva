<?php

declare(strict_types=1);

namespace Auth\Domain\Token;

use Ramsey\Uuid\UuidInterface;

interface TokenFindRepository
{
    /**
     * @param UuidInterface $id
     *
     * @return Token|null
     */
    public function find(UuidInterface $id) : ?Token;

    /**
     * @param UuidInterface $id
     *
     * @return Token
     * @throw class NotFoundException
     */
    public function findOrFail(UuidInterface $id) : Token;
}