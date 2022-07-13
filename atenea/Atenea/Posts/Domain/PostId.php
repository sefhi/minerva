<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\ValueObject\Primitive\IntValueObject;

final class PostId extends IntValueObject
{
    public function __toString(): string
    {
        return (string) $this->value();
    }
}
