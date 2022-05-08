<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Shared\Domain\ValueObject;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
use Minerva\Shared\Domain\ValueObject\Website;

final class WebsiteMother
{
    public static function create(string $value): Website
    {
        return new Website($value);
    }

    public static function random(): Website
    {
        return self::create(MotherCreator::random()->domainName());
    }
}
