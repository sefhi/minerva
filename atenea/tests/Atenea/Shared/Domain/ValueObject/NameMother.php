<?php

declare(strict_types=1);

namespace Atenea\Tests\Shared\Domain\ValueObject;

use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Shared\Domain\ValueObject\Name;

final class NameMother
{
    public static function create(string $value): Name
    {
        return new Name($value);
    }

    public static function random(): Name
    {
        return self::create(MotherCreator::random()->name());
    }
}
