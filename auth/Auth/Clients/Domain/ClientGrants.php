<?php

declare(strict_types=1);

namespace Auth\Clients\Domain;

use Auth\Shared\Domain\ValueObject\ArrayValues;
use InvalidArgumentException;

final class ClientGrants implements ArrayValues
{

    public function __construct(private readonly array $values)
    {
        $this->ensureIsValidGrant($this->values);
    }

    /**
     * @inheritDoc
     */
    public function getValues(): array
    {
        return $this->values;
    }

    private function ensureIsValidGrant(array $values): void
    {
        foreach ($values as $value) {
            if (is_null(Grant::tryFrom($value))) {
                $valuesAllowed = implode(', ', array_column(Grant::cases(), 'value'));
                throw new InvalidArgumentException(
                    sprintf('The grant <%s> is not one of the allowed values (%s)', $value, $valuesAllowed)
                );
            }
        }
    }

}