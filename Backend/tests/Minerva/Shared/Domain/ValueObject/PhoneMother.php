<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Shared\Domain\ValueObject;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
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
