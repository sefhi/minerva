<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

use Auth\Shared\Domain\ValueObject\StringValueObject;

final class ClientIdentifier extends StringValueObject
{

    public static function fromString(string $value): self
    {
        return new self($value);
    }
}
