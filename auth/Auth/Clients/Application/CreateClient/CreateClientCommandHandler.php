<?php

declare(strict_types=1);

namespace Auth\Clients\Application\CreateClient;

use Auth\Clients\Domain\Client;
use Auth\Clients\Domain\ClientCredentialsParam;
use Auth\Clients\Domain\ClientSaveRepository;
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