<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Atenea\Tests\Shared\Domain\ValueObject\NameMother;
use Atenea\Tests\Shared\Domain\ValueObject\UsernameMother;
use Atenea\Tests\Shared\Domain\ValueObject\WebsiteMother;
use Atenea\Posts\Domain\PostAuthor;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Shared\Domain\ValueObject\Email;
use Atenea\Shared\Domain\ValueObject\Name;
use Atenea\Shared\Domain\ValueObject\Username;
use Atenea\Shared\Domain\ValueObject\Website;
use Atenea\Tests\Shared\Domain\ValueObject\EmailMother;

final class PostAuthorMother
{
    public static function create(
        AuthorId $id,
        Name $name,
        Username $username,
        Website $website,
        Email $email
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
            NameMother::random(),
            UsernameMother::random(),
            WebsiteMother::random(),
            EmailMother::random(),
        );
    }
}
