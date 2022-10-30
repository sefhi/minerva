<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\Client;

use Auth\Shared\Domain\ValueObject\StringValueObject;

final class ClientSecret extends StringValueObject
{
    public function __toString(): string
    {
        return $this->value();
    }

    public static function fromString(string $value) : self
    {
        return new self($value);
    }
}