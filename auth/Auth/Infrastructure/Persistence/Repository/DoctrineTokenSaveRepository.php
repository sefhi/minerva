<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Repository;

use Auth\Domain\Token\Token;
use Auth\Domain\Token\TokenSaveRepository;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineTokenSaveRepository extends DoctrineRepository implements TokenSaveRepository
{
    public function save(Token $token): void
    {
        $this->persist($token);
    }
}
