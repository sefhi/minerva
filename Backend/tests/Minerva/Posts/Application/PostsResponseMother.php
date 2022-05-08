<?php

declare(strict_types=1);

namespace Minerva\Tests\Posts\Application;

use Minerva\Posts\Application\PostsResponse;

final class PostsResponseMother
{
    public static function create(array $posts): PostsResponse
    {
        return PostsResponse::create($posts);
    }

    public static function random(): PostsResponse
    {
        $postResponse = [];
        $limit = random_int(1, 10);

        for ($i = 0; $i < $limit; ++$i) {
            $postResponse[] = PostResponseMother::random();
        }

        return PostsResponse::create($postResponse);
    }
}
