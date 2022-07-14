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
        ?PostAuthorName $name = null,
        ?PostAuthorUsername $username = null,
        ?PostAuthorWebsite $website = null,
        ?PostAuthorEmail $email = null,
        ?AuthorId $id = null,
    ): PostAuthor {
        return PostAuthor::create(
            $name ?? PostAuthorNameMother::random(),
            $username ?? PostAuthorUsernameMother::random(),
            $website ?? PostAuthorWebsiteMother::random(),
            $email ?? PostAuthorEmailMother::random(),
            $id ?? AuthorIdMother::random(),
        );
    }

    public static function fromId(AuthorId $id): PostAuthor
    {
        return self::create(
            PostAuthorNameMother::random(),
            PostAuthorUsernameMother::random(),
            PostAuthorWebsiteMother::random(),
            PostAuthorEmailMother::random(),
            $id,
        );
    }

    public static function random(): PostAuthor
    {
        return self::create(
            PostAuthorNameMother::random(),
            PostAuthorUsernameMother::random(),
            PostAuthorWebsiteMother::random(),
            PostAuthorEmailMother::random(),
            AuthorIdMother::random(),
        );
    }
}
