<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Repository;

use Auth\Domain\RefreshToken\RefreshToken;
use Auth\Domain\RefreshToken\RefreshTokenFindRepository;
use Auth\Shared\Domain\Exception\NotFoundException;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineRefreshTokenFindRepository extends DoctrineRepository implements RefreshTokenFindRepository
{
    public function find(UuidInterface $id): ?RefreshToken
    {
        return $this->repository(RefreshToken::class)->find($id);
    }

    public function findOrFail(UuidInterface $id): RefreshToken
    {
        $refreshTokenFound = $this->find($id);

        if (null === $refreshTokenFound) {
            throw NotFoundException::entityWithId(RefreshToken::class, $id);
        }

        return $refreshTokenFound;
    }
}
