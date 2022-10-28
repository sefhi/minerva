<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence;

use Auth\Clients\Domain\Client;
use Auth\Clients\Domain\ClientFindRepository;
use Auth\Clients\Domain\ClientIdentifier;
use Auth\Clients\Domain\ClientSecret;
use Auth\Clients\Domain\Grant;
use Auth\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineClientFindRepository extends DoctrineRepository implements ClientFindRepository
{

    public function find(UuidInterface $id): Client
    {
        // TODO: Implement find() method.
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

        if ((string)$client->getCredentials()->getSecret() === (string)$secret) {
            return true;
        }

        return false;
    }
}