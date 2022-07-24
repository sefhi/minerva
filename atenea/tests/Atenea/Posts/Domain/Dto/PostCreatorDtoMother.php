<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain\Dto;

use Atenea\Posts\Domain\PostAuthor;
use Atenea\Posts\Domain\PostId;
use Atenea\Tests\Posts\Domain\PostAuthorMother;
use Atenea\Tests\Posts\Domain\PostContentMother;
use Atenea\Tests\Posts\Domain\PostIdMother;
use Atenea\Tests\Posts\Domain\PostTitleMother;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostTitle;

final class PostCreatorDtoMother
{
    public static function create(
        PostId $id,
        PostTitle $title,
        PostContent $content,
        PostAuthor $author
    ): PostCreatorDto {
        return PostCreatorDto::create($id, $title, $content, $author);
    }

    public static function random(): PostCreatorDto
    {
        return self::create(
            PostIdMother::random(),
            PostTitleMother::random(),
            PostContentMother::random(),
            PostAuthorMother::random(),
        );
    }
}
