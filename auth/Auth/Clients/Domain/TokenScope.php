<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

use Auth\Shared\Domain\ValueObject\ArrayValues;

final class TokenScope implements ArrayValues
{

    public function __construct(private array $values)
    {
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }
}