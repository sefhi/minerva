<?php

declare(strict_types=1);

namespace Minerva\Shared\Domain\ValueObject\Primitive;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
