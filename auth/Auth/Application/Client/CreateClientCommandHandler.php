<?php

declare(strict_types=1);

namespace Auth\Application\Client;

use Auth\Domain\Client\Client;
use Auth\Domain\Client\ClientCredentialsParam;
use Auth\Domain\Client\ClientSaveRepository;
use Exception;

final class CreateClientCommandHandler
{

    public function __construct(private readonly ClientSaveRepository $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(CreateClientCommand $command) : Client
    {
        $client = Client::create(
            ClientCredentialsParam::createByName($command->getName()),
            $command->getRedirectUris(),
            $command->getGrants(),
            $command->getScopes(),
        );

        $this->repository->save($client);

        return $client;
    }
}