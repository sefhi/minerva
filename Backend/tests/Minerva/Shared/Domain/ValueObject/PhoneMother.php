<?php

declare(strict_types=1);

namespace Minerva\Tests\Shared\Domain\ValueObject;

use Minerva\Tests\Shared\Domain\MotherCreator;
use Minerva\Shared\Domain\ValueObject\Phone;

final class PhoneMother
{
    public static function create(string $value): Phone
    {
        return new Phone($value);
    }

    public static function random(): Phone
    {
        return self::create(MotherCreator::random()->phoneNumber());
    }
}
