<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Doctrine\Mapping\Token;

use Doctrine\DBAL\Types\JsonType;

final class TokenScopesType extends JsonType
{
    private const NAME = 'token_scopes';

    public function getName(): string
    {
        return self::NAME;
    }
}
