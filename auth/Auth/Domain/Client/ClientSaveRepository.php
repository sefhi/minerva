<?php

namespace Auth\Domain\Client;

interface ClientSaveRepository
{
    public function save(Client $client): void;
}
