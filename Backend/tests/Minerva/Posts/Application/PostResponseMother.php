<?php

declare(strict_types=1);

namespace Minerva\Tests\Posts\Application;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
use Minerva\Posts\Application\PostAuthorResponse;
use Minerva\Posts\Application\PostResponse;

final class PostResponseMother
{
    public static function create(
        int $id,
        string $title,
        string $content,
        PostAuthorResponse $author
    ): PostResponse {
        return PostResponse::create($id, $title, $content, $author);
    }

    public static function random(): PostResponse
    {
        return self::create(
            random_int(1, 1000),
            MotherCreator::random()->title(),
            MotherCreator::random()->paragraph(random_int(1, 3)),
            PostAuthorResponseMother::random(),
        );
    }
}
