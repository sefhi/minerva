<?php

declare(strict_types=1);

namespace Auth\Domain\RefreshToken;

use Ramsey\Uuid\UuidInterface;

interface RefreshTokenFindRepository
{
    public function find(UuidInterface $id): ?RefreshToken;

    public function findOrFail(UuidInterface $id): RefreshToken;
}
