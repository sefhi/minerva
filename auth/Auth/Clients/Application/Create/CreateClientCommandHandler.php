<?php

declare(strict_types=1);

namespace Auth\Clients\Application\Create;

use Auth\Clients\Domain\Client;
use Auth\Clients\Domain\ClientSaveRepository;

final class CreateClientCommandHandler
{

    public function __construct(private ClientSaveRepository $repository)
    {
    }

    public function __invoke(CreateClientCommand $command)
    {
//        $this->repository->save();
    }
}