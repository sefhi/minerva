<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Domain;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
use Minerva\Posts\Domain\Post;

final class PostMother
{
    public static function create(
        int $id,
        string $title,
        string $content,
        int $userId
    ): Post {
        return Post::create($id, $title, $content, $userId);
    }

    public static function random(): Post
    {
        return self::create(
            random_int(1, 1000),
            MotherCreator::random()->title(),
            MotherCreator::random()->paragraph(random_int(1, 3)),
            random_int(1, 1000),
        );
    }

    public static function array(): array
    {
        $posts = [];
        $limit = random_int(1, 10);

        for ($i = 0; $i < $limit; ++$i) {
            $posts[] = self::random();
        }

        return $posts;
    }
}
