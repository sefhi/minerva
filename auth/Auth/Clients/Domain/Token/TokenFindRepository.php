<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\Token;

use Auth\Clients\Domain\Token;
use Ramsey\Uuid\UuidInterface;

interface TokenFindRepository
{
    /**
     * @param UuidInterface $id
     * @return Token|null
     */
    public function find(UuidInterface $id) : ?Token;

    public function findOrFail(UuidInterface $id) : Token;
}