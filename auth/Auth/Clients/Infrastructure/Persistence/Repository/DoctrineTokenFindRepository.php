<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence\Repository;

use Auth\Clients\Domain\Token\Token;
use Auth\Clients\Domain\Token\TokenFindRepository;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Exception;
use Ramsey\Uuid\UuidInterface;

final class DoctrineTokenFindRepository extends DoctrineRepository implements TokenFindRepository
{

    /**
     * @inheritDoc
     */
    public function find(UuidInterface $id): ?Token
    {
        return $this->repository(Token::class)->find($id);
    }

    public function findOrFail(UuidInterface $id): Token
    {
        $token = $this->find($id);

        if (null === $token) {
            //TODO exception
            throw new Exception('Token not found');
        }

        return $token;
    }
}
