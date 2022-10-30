<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence;

use Auth\Clients\Domain\Client\Client;
use Auth\Clients\Domain\Client\ClientSaveRepository;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineClientSaveRepository extends DoctrineRepository implements ClientSaveRepository
{

    public function save(Client $client): void
    {
        $this->persist($client);
    }
}