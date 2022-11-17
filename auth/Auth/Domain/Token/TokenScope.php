<?php

declare(strict_types=1);

namespace Auth\Domain\Token;

use Auth\Shared\Domain\ValueObject\ArrayValues;

final class TokenScope implements ArrayValues
{
    public function __construct(private array $values)
    {
    }

    public function getValues(): array
    {
        return $this->values;
    }
}
