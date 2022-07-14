<?php

declare(strict_types=1);

namespace App\Tests\Atenea\Authors\Domain;

use Atenea\Authors\Domain\Author;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Shared\Domain\ValueObject\Email;
use Atenea\Shared\Domain\ValueObject\Name;
use Atenea\Shared\Domain\ValueObject\Username;
use Atenea\Shared\Domain\ValueObject\Website;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Atenea\Tests\Shared\Domain\ValueObject\EmailMother;
use Atenea\Tests\Shared\Domain\ValueObject\NameMother;
use Atenea\Tests\Shared\Domain\ValueObject\UsernameMother;
use Atenea\Tests\Shared\Domain\ValueObject\WebsiteMother;

final class AuthorMother
{
    public static function create(
        ?AuthorId $id = null,
        ?Name $name = null,
        ?Username $username = null,
        ?Website $web = null,
        ?Email $email = null
    ): Author {
        return Author::create(
            $id ?? AuthorIdMother::random(),
            $name ?? NameMother::random(),
            $username ?? UsernameMother::random(),
            $web ?? WebsiteMother::random(),
            $email ?? EmailMother::random(),
        );
    }

    public static function fromId(
        AuthorId $id = null,
    ): Author {
        return Author::create(
            $id,
            NameMother::random(),
            UsernameMother::random(),
            WebsiteMother::random(),
            EmailMother::random(),
        );
    }
}
