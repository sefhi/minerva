<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostId;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;

final class PostMother
{
    public static function create(
        PostTitle $title,
        PostContent $content,
        AuthorId $authorId,
        ?PostId $id = null
    ): Post {
        return Post::create($title, $content, $authorId, $id);
    }

    public static function random(): Post
    {
        return self::create(
            PostTitleMother::random(),
            PostContentMother::random(),
            AuthorIdMother::random(),
            PostIdMother::random(),
        );
    }

    /**
     * @return array<Post>
     *
     * @throws \Exception
     */
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
