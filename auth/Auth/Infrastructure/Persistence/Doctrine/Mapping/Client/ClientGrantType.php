<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Doctrine\Mapping\Client;

use Auth\Shared\Infrastructure\Persistence\Doctrine\Dbal\Type\AbstractJsonType;

final class ClientGrantType extends AbstractJsonType
{

    private const NAME = 'auth_grant';

    public function getName(): string
    {
        return self::NAME;
    }
}
