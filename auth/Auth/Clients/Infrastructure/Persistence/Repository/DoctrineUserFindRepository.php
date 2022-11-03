<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence\Repository;

use Auth\Clients\Domain\User\User;
use Auth\Clients\Domain\User\UserFindRepository;
use Auth\Shared\Domain\Exception\NotFoundException;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineUserFindRepository extends DoctrineRepository implements UserFindRepository
{

    public function find(UuidInterface $id): ?User
    {
        return $this->repository(User::class)->find($id);
    }

    public function findOneByEmailOrFail(string $email): User
    {
        $userFound = $this->repository(User::class)->findOneBy(['email' => $email]);

        if (null === $userFound) {
            throw NotFoundException::entityWithEmail(User::class, $email);
        }

        return $userFound;
    }

    public function findOrFail(UuidInterface $id): User
    {
        $userFound = $this->find($id);

        if (null === $userFound) {
            throw NotFoundException::entityWithId(User::class, $id);
        }

        return $userFound;
    }
}
