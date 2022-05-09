<?php

declare(strict_types=1);

namespace Minerva\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Minerva\Shared\Domain\ValueObject\Primitive\StringValueObject;

final class Name extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->checkLength(3, 50);
        $this->checkValidName();
    }

    public function checkValidName(): bool
    {
        if (!preg_match('/^([A-Za-z .ñáéíóúÑÁÉÍÓÚ]{2,60})$/u', $this->value)) {
            throw new InvalidArgumentException(sprintf('%s is not valid in %s', $this->value, __CLASS__), 400);
        }

        return true;
    }
}
