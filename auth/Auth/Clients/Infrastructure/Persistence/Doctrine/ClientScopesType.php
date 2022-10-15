<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence\Doctrine;

use Auth\Clients\Domain\ClientScopes;
use Doctrine\DBAL\Types\JsonType;

final class ClientScopesType extends JsonType
{
    private const NAME = 'auth_redirect_uris';

    public function getName(): string
    {
        return self::NAME;
    }
}