<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Shared\Domain\ValueObject;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
use Minerva\Shared\Domain\ValueObject\Name;

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
