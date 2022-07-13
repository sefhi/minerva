<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Posts\Domain\PostAuthorEmail;
use Atenea\Posts\Domain\PostAuthorName;
use Atenea\Posts\Domain\PostAuthorUsername;
use Atenea\Posts\Domain\PostAuthorWebsite;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Atenea\Posts\Domain\PostAuthor;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

final class PostAuthorMother
{
    public static function create(
        AuthorId $id,
        PostAuthorName $name,
        PostAuthorUsername $username,
        PostAuthorWebsite $website,
        PostAuthorEmail $email
    ): PostAuthor {
        return PostAuthor::create(
            $id,
            $name,
            $username,
            $website,
            $email
        );
    }

    public static function random(): PostAuthor
    {
        return self::create(
            AuthorIdMother::random(),
            PostAuthorNameMother::random(),
            PostAuthorUsernameMother::random(),
            PostAuthorWebsiteMother::random(),
            PostAuthorEmailMother::random(),
        );
    }
}
