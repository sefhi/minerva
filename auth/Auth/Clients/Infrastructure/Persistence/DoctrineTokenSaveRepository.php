<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence;

use Auth\Clients\Domain\Token;
use Auth\Clients\Domain\TokenSaveRepository;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineTokenSaveRepository extends DoctrineRepository implements TokenSaveRepository
{

    public function save(Token $token): void
    {
        $this->persist($token);
    }
}