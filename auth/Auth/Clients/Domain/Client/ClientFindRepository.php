<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\Client;

use Ramsey\Uuid\UuidInterface;

interface ClientFindRepository
{
    public function find(UuidInterface $id): Client;

    public function findByIdentifier(ClientIdentifier $identifier): ?Client;

    public function validateClient(ClientIdentifier $identifier, ClientSecret $secret, Grant $grant): bool;
}
