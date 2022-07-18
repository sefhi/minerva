<?php

declare(strict_types=1);

namespace Atenea\Tests\Shared\Domain\ValueObject;

use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Shared\Domain\ValueObject\Username;

class UsernameMother
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
