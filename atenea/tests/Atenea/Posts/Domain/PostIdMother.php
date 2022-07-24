<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Posts\Domain\PostId;
use Atenea\Tests\Shared\Domain\MotherCreator;

final class PostIdMother
{
    public static function create(string $id): PostId
    {
        return new PostId($id);
    }

    public static function random(): PostId
    {
        return self::create(MotherCreator::random()->uuid());
    }
}
