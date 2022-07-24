<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Shared\Domain\ValueObject\AuthorId;
use Atenea\Shared\Domain\ValueObject\Email;
use Atenea\Shared\Domain\ValueObject\Name;
use Atenea\Shared\Domain\ValueObject\Username;
use Atenea\Shared\Domain\ValueObject\Website;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Atenea\Posts\Domain\PostAuthor;
use Atenea\Tests\Shared\Domain\ValueObject\EmailMother;
use Atenea\Tests\Shared\Domain\ValueObject\NameMother;
use Atenea\Tests\Shared\Domain\ValueObject\UsernameMother;
use Atenea\Tests\Shared\Domain\ValueObject\WebsiteMother;

final class PostAuthorMother
{
    public static function create(
        ?AuthorId $id = null,
        ?Name $name = null,
        ?Username $username = null,
        ?Website $website = null,
        ?Email $email = null,
    ): PostAuthor {
        return PostAuthor::create(
            $id ?? AuthorIdMother::random(),
            $name ?? NameMother::random(),
            $username ?? UsernameMother::random(),
            $website ?? WebsiteMother::random(),
            $email ?? EmailMother::random(),
        );
    }

    public static function fromId(AuthorId $id): PostAuthor
    {
        return self::create(
            $id,
            NameMother::random(),
            UsernameMother::random(),
            WebsiteMother::random(),
            EmailMother::random(),
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
