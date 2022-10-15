<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence\Doctrine;

use Auth\Clients\Domain\ClientRedirectUris;
use Doctrine\DBAL\Types\JsonType;

final class ClientScopesType extends JsonType
{
    private const NAME = 'auth_redirect_uris';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function convertDatabaseValues(array $values): array
    {
        return array_map(static fn(string $value) => new ClientRedirectUris($value), $values);
    }
}