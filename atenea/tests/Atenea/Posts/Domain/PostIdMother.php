<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Posts\Domain\PostId;

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
