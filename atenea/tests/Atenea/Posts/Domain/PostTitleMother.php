<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Posts\Domain\PostTitle;

final class PostTitleMother
{
    public static function create(string $value): PostTitle
    {
        return new PostTitle($value);
    }

    public static function random(): PostTitle
    {
        return self::create(MotherCreator::random()->realText(50));
    }
}
