<?php

declare(strict_types=1);

namespace Auth\Shared\Infrastructure\Persistence\Doctrine;

use Auth\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    protected function entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function persist(AggregateRoot $entity): void
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush($entity);
    }

    protected function remove(AggregateRoot $entity): void
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush($entity);
    }

    protected function repository(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}
