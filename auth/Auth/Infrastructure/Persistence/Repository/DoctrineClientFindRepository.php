<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Repository;

use Auth\Domain\Client\Client;
use Auth\Domain\Client\ClientFindRepository;
use Auth\Domain\Client\ClientIdentifier;
use Auth\Domain\Client\ClientSecret;
use Auth\Domain\Client\Grant;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineClientFindRepository extends DoctrineRepository implements ClientFindRepository
{
    public function find(UuidInterface $id): ?Client
    {
        return $this->repository(Client::class)->find($id);
    }

    public function findByIdentifier(ClientIdentifier $identifier): ?Client
    {
        return $this->repository(Client::class)->findOneBy(['credentials.identifier.value' => $identifier->value()]);
    }

    public function validateClient(ClientIdentifier $identifier, ClientSecret $secret, Grant $grant): bool
    {
        /** @var Client $client */
        $client = $this->findByIdentifier($identifier);

        if (null === $client ||
            !$client->isActive() ||
            !$client->isGrantSupported($client, $grant->value)
        ) {
            return false;
        }

        if ((string) $client->getCredentials()->getSecret() === (string) $secret) {
            return true;
        }

        return false;
    }
}
