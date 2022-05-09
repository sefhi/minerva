<?php

declare(strict_types=1);

namespace Minerva\Shared\Domain\ValueObject\Primitive;

use InvalidArgumentException;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }

    protected function checkLength(int $minLength, int $maxLength): bool
    {
        $length = strlen($this->value());
        if ($length < $minLength || $length > $maxLength) {
            throw new InvalidArgumentException(sprintf('%s must have a length between %s and %s character.', static::class, $minLength, $maxLength), 400);
        }

        return true;
    }
}
