<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\Client;

use Auth\Shared\Domain\ValueObject\ArrayValues;
use InvalidArgumentException;

final class ClientRedirectUris implements ArrayValues
{
    public function __construct(private array $values)
    {
        $this->ensureIsValidUrl($values);
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    private function ensureIsValidUrl(array $values): void
    {
        foreach ($values as $value) {
            if (!filter_var($value, FILTER_VALIDATE_URL)) {
                throw new InvalidArgumentException(
                    sprintf('The redirectUris <%s> is not valid', $value)
                );
            }
        }
    }

}