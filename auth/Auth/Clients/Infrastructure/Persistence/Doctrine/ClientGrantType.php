<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Types\JsonType;

final class ClientGrantType extends JsonType
{

    private const NAME = 'auth_grant';

    public function getName(): string
    {
        return self::NAME;
    }
}
