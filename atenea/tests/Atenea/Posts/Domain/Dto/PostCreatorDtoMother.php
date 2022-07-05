<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain\Dto;

use Atenea\Tests\Posts\Domain\PostContentMother;
use Atenea\Tests\Posts\Domain\PostTitleMother;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

final class PostCreatorDtoMother
{
    public static function create(
        PostTitle $title,
        PostContent $content,
        AuthorId $id
    ): PostCreatorDto {
        return PostCreatorDto::create($title, $content, $id);
    }

    public static function random(): PostCreatorDto
    {
        return self::create(
            PostTitleMother::random(),
            PostContentMother::random(),
            AuthorIdMother::random(),
        );
    }
}
