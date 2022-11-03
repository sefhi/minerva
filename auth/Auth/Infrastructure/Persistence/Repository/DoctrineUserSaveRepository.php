<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Repository;

use Auth\Domain\User\User;
use Auth\Domain\User\UserSaveRepository;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineUserSaveRepository extends DoctrineRepository implements UserSaveRepository
{
    public function save(User $user): void
    {
        $this->persist($user);
    }
}