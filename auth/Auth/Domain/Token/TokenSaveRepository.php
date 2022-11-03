<?php

declare(strict_types=1);

namespace Auth\Domain\Token;

interface TokenSaveRepository
{
    public function save(Token $token): void;
}