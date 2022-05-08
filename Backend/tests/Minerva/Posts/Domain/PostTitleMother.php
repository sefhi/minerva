<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Domain;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
use Minerva\Posts\Domain\PostTitle;

final class PostTitleMother
{
    public static function create(string $value): PostTitle
    {
        return new PostTitle($value);
    }

    public static function random(): PostTitle
    {
        return self::create(MotherCreator::random()->title());
    }
}
