<?php

declare(strict_types=1);

namespace Minerva\Tests\Posts\Domain;

use Minerva\Posts\Domain\Post;
use Minerva\Posts\Domain\PostAuthor;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostId;
use Minerva\Posts\Domain\PostTitle;

final class PostMother
{
    public static function create(
        PostId $id,
        PostTitle $title,
        PostContent $content,
        PostAuthor $author
    ): Post {
        return Post::create($id, $title, $content, $author);
    }

    public static function random(): Post
    {
        return self::create(
            PostIdMother::random(),
            PostTitleMother::random(),
            PostContentMother::random(),
            PostAuthorMother::random(),
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
