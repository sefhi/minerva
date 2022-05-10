<?php

declare(strict_types=1);

namespace Minerva\Tests\Shared\Domain\ValueObject;

use Minerva\Tests\Shared\Domain\MotherCreator;
use Minerva\Shared\Domain\ValueObject\Email;

final class EmailMother
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
