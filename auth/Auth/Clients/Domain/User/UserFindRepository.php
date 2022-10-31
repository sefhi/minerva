<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\User;

use Ramsey\Uuid\UuidInterface;

interface UserFindRepository
{
    public function find(UuidInterface $id): ?User;
}
