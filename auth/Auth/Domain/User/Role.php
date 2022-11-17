<?php

declare(strict_types=1);

namespace Auth\Domain\User;

use Auth\Shared\Domain\ValueObject\StringValueObject;

final class Role extends StringValueObject
{
    public static function fromString(string $value): StringValueObject
    {
        return new self($value);
    }
}
