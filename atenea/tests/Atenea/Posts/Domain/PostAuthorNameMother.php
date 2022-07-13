<?php

namespace Atenea\Tests\Posts\Domain;

use Atenea\Posts\Domain\PostAuthorName;
use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Tests\Shared\Domain\ValueObject\NameMother;

class PostAuthorNameMother extends NameMother
{
    public static function create(string $value): PostAuthorName
    {
        return new PostAuthorName($value);
    }

    public static function random(): PostAuthorName
    {
        return self::create(MotherCreator::random()->name());
    }
}
