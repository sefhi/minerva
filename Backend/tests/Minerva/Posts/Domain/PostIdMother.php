<?php

declare(strict_types=1);

namespace Minerva\Tests\Posts\Domain;

use Minerva\Posts\Domain\PostId;

final class PostIdMother
{
    public static function create(int $id): PostId
    {
        return new PostId($id);
    }

    public static function random(): PostId
    {
        return self::create(random_int(1, 1000));
    }
}
