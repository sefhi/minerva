<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

interface TokenSaveRepository
{
    public function save(Token $token): void;
}