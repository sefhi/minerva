<?php

declare(strict_types=1);

namespace Auth\Domain\User;

use Ramsey\Uuid\UuidInterface;

interface UserFindRepository
{
    public function find(UuidInterface $id): ?User;

    public function findOrFail(UuidInterface $id): User;

    public function findOneByEmailOrFail(Email $email): User;

    public function existUserByEmail(Email $email): void;
}
