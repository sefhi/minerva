<?php

declare(strict_types=1);

namespace Auth\Domain\Bearer;

use Auth\Shared\Domain\ValueObject\StringValueObject;
use InvalidArgumentException;

final class TokenBearer extends StringValueObject
{

    public function __construct(protected string $value)
    {
        $this->ensureIsValidBearer($this->value);
        parent::__construct($this->clearBearer($this->value));
    }

    private function clearBearer(string $value): string
    {
        return trim((string)\preg_replace('/^\s*Bearer\s/', '', $value));
    }

    private function ensureIsValidBearer(string $value): void
    {
        if (!str_contains($value, 'Bearer')) {
            throw new InvalidArgumentException(
                sprintf('The Bearer <%s> is not valid', $value)
            );
        }
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }
}
