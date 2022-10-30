<?php

namespace Auth\Clients\Domain\Client;

interface ClientSaveRepository
{
    public function save(Client $client): void;
}