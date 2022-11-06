<?php

declare(strict_types=1);

namespace Auth\Domain\RefreshToken;

interface RefreshTokenSaveRepository
{
    public function save(RefreshToken $refreshToken): void;
}