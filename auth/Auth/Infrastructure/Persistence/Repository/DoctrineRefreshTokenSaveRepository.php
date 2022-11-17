<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Repository;

use Auth\Domain\RefreshToken\RefreshToken;
use Auth\Domain\RefreshToken\RefreshTokenSaveRepository;

final class DoctrineRefreshTokenSaveRepository implements RefreshTokenSaveRepository
{
    public function save(RefreshToken $refreshToken): void
    {
        // TODO: Implement save() method.
    }
}
