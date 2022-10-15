<?php

namespace Auth\Clients\Domain;

interface ClientSaveRepository
{
    public function save(Client $client): void;
}