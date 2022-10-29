<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\AccessToken;

final class CryptKeyPrivate extends CryptKey
{

    public static function create(
        string $keyPath,
        string $passPhrase = '',
        bool $keyPermissionsCheck = true
    ): self {
        return new self($keyPath, $passPhrase, $keyPermissionsCheck);
    }
}