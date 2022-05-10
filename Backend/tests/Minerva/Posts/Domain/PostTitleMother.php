<?php

declare(strict_types=1);

namespace Minerva\Tests\Posts\Domain;

use Minerva\Tests\Shared\Domain\MotherCreator;
use Minerva\Posts\Domain\PostTitle;

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
