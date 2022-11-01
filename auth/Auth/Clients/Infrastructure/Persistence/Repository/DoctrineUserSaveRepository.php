<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence\Repository;

use Auth\Clients\Domain\User\User;
use Auth\Clients\Domain\User\UserSaveRepository;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineUserSaveRepository extends DoctrineRepository implements UserSaveRepository
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
        parent::__construct($this->entityManager);
    }

    public function save(User $user): void
    {
        $this->persist($user);
    }
}