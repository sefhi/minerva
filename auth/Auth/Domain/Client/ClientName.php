<?php

declare(strict_types=1);

namespace Auth\Domain\Client;

use Auth\Shared\Domain\ValueObject\StringValueObject;

final class ClientName extends StringValueObject
{

    public static function fromString(string $value): self
    {
        return new self($value);
    }
}