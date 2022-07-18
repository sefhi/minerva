<?php

declare(strict_types=1);

namespace Atenea\Shared\Domain\ValueObject;

use Atenea\Shared\Domain\ValueObject\Primitive\StringValueObject;

class Username extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->checkLength(2, 70);
    }
}
