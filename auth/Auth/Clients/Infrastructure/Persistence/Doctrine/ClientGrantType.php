<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Persistence\Doctrine;

use Auth\Clients\Domain\ClientGrants;
use Doctrine\DBAL\Types\JsonType;

final class ClientGrantType extends JsonType
{

    private const NAME = 'auth_grant';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function convertDatabaseValues(array $values): array
    {
        return array_map(static fn (string $value) => new ClientGrants($value), $values);
    }
}