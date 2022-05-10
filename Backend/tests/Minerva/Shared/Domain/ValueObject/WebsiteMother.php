<?php

declare(strict_types=1);

namespace Minerva\Tests\Shared\Domain\ValueObject;

use Minerva\Tests\Shared\Domain\MotherCreator;
use Minerva\Shared\Domain\ValueObject\Website;

final class WebsiteMother
{
    public static function create(string $value): Website
    {
        return new Website($value);
    }

    public static function random(): Website
    {
        return self::create(MotherCreator::random()->url());
    }
}
