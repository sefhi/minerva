<?php

declare(strict_types=1);

namespace Auth\Domain\User;

use Auth\Shared\Domain\ValueObject\StringValueObject;

final class Email extends StringValueObject
{

    public static function fromString(string $value): self
    {
        return new self($value);
    }
}
