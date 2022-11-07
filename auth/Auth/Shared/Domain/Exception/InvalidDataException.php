<?php

declare(strict_types=1);

namespace Auth\Shared\Domain\Exception;

use DomainException;

final class InvalidDataException extends DomainException
{
    public static function parameterRequired(string $parameter) : self
    {
        return new self(sprintf("Field '%s' is required", $parameter));
    }
}