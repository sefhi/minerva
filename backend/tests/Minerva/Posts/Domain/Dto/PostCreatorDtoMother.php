<?php

declare(strict_types=1);

namespace Minerva\Tests\Posts\Domain\Dto;

use Minerva\Tests\Posts\Domain\PostContentMother;
use Minerva\Tests\Posts\Domain\PostTitleMother;
use Minerva\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Minerva\Posts\Domain\Dto\PostCreatorDto;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;

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
