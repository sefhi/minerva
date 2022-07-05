<?php

declare(strict_types=1);

namespace Minerva\Shared\Domain\ValueObject;

use Minerva\Shared\Domain\ValueObject\Primitive\StringValueObject;

final class Username extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->checkLength(2, 70);
    }
}
