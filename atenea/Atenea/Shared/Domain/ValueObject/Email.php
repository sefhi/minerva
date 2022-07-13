<?php

declare(strict_types=1);

namespace Atenea\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Atenea\Shared\Domain\ValueObject\Primitive\StringValueObject;

class Email extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->checkValidEmail();
    }

    public function checkValidEmail(): bool
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('Email %s is not valid in %s', $this->value, __CLASS__), 400);
        }

        return true;
    }
}
