<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use App\Tests\Atenea\Authors\Domain\AuthorMother;
use Atenea\Authors\Domain\Author;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostId;
use Atenea\Posts\Domain\PostTitle;

final class PostMother
{
    public static function create(
        PostId $id,
        PostTitle $title,
        PostContent $content,
        Author $author,
    ): Post {
        return Post::create($id, $title, $content, $author);
    }

    public static function random(): Post
    {
        return self::create(
            PostIdMother::random(),
            PostTitleMother::random(),
            PostContentMother::random(),
            AuthorMother::random(),
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
