<?php

declare(strict_types=1);

namespace Minerva\Tests\Shared\Domain\ValueObject;

use Minerva\Tests\Shared\Domain\MotherCreator;
use Minerva\Shared\Domain\ValueObject\Username;

final class UsernameMother
{
    public static function create(string $value): Username
    {
        return new Username($value);
    }

    public static function random(): Username
    {
        return self::create(MotherCreator::random()->userName());
    }
}
