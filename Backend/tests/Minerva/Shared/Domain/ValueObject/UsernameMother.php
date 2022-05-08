<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Shared\Domain\ValueObject;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
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
