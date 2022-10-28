<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

use Auth\Shared\Domain\ValueObject\StringValueObject;

final class ClientSecret extends StringValueObject
{
    public function __toString(): string
    {
        return $this->value();
    }
}