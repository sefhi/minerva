<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\Client;

use Auth\Shared\Domain\ValueObject\StringValueObject;
use Exception;

final class ClientSecret extends StringValueObject
{
    public function __toString(): string
    {
        return $this->value();
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    /**
     * @throws Exception
     */
    public static function generate(): self
    {
        return new self(hash('sha512', random_bytes(32)));
    }
}