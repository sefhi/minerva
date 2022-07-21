<?php

declare(strict_types=1);

namespace Atenea\Shared\Domain\ValueObject;

use Atenea\Shared\Domain\ValueObject\Primitive\IntValueObject;

final class AuthorId extends IntValueObject
{
    public function __toString(): string
    {
        return (string) $this->value();
    }
}
