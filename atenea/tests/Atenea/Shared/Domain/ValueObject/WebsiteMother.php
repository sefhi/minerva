<?php

declare(strict_types=1);

namespace Atenea\Tests\Shared\Domain\ValueObject;

use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Shared\Domain\ValueObject\Website;

class WebsiteMother
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
