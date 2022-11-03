<?php

declare(strict_types=1);

namespace Auth\Domain\Client;

use Auth\Shared\Domain\ValueObject\StringValueObject;
use Exception;

final class ClientIdentifier extends StringValueObject
{

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    /**
     * @throws Exception
     */
    public static function generate() : self
    {
        return new self(hash('md5', random_bytes(16)));
    }
}
