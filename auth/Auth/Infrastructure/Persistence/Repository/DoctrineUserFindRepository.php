<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Repository;

use Auth\Domain\User\Email;
use Auth\Domain\User\User;
use Auth\Domain\User\UserFindRepository;
use Auth\Shared\Domain\Exception\NotFoundException;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineUserFindRepository extends DoctrineRepository implements UserFindRepository
{

    public function find(UuidInterface $id): ?User
    {
        return $this->repository(User::class)->find($id);
    }

    public function findOneByEmailOrFail(Email $email): User
    {
        $userFound = $this->repository(User::class)->findOneBy(['email.value' => $email->value()]);

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
