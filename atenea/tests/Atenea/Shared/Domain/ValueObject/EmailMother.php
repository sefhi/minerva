<?php

declare(strict_types=1);

namespace Atenea\Tests\Shared\Domain\ValueObject;

use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Shared\Domain\ValueObject\Email;

class EmailMother
{
    public static function create(string $value): Email
    {
        return new Email($value);
    }

    public static function random(): Email
    {
        return self::create(MotherCreator::random()->email());
    }
}
