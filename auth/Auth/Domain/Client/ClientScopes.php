<?php

declare(strict_types=1);

namespace Auth\Domain\Client;

use Auth\Shared\Domain\ValueObject\ArrayValues;

final class ClientScopes implements ArrayValues
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