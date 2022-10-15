<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence;

use Auth\Clients\Domain\Client;
use Auth\Clients\Domain\ClientSaveRepository;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineClientSaveRepository extends DoctrineRepository implements ClientSaveRepository
{

    public function save(Client $client): void
    {
        $this->persist($client);
    }
}