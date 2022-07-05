<?php

declare(strict_types=1);

namespace Minerva\Posts\Domain;

use Minerva\Shared\Domain\ValueObject\Primitive\StringValueObject;

final class PostTitle extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->checkLength(5, 100);
    }
}
