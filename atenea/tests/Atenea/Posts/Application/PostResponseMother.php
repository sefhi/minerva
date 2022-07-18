<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Application;

use DateTimeImmutable;
use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Posts\Application\PostAuthorResponse;
use Atenea\Posts\Application\PostResponse;

final class PostResponseMother
{
    public static function create(
        int $id,
        string $title,
        string $content,
        DateTimeImmutable $createdAt,
        PostAuthorResponse $author
    ): PostResponse {
        return PostResponse::create($id, $title, $content, $createdAt, $author);
    }

    public static function random(): PostResponse
    {
        return self::create(
            random_int(1, 1000),
            MotherCreator::random()->title(),
            MotherCreator::random()->paragraph(random_int(1, 3)),
            new DateTimeImmutable(),
            PostAuthorResponseMother::random(),
        );
    }
}
