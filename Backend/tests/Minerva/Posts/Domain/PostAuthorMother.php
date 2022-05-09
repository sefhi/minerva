<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Domain;

use App\Tests\Minerva\Shared\Domain\ValueObject\Author\AuthorIdMother;
use App\Tests\Minerva\Shared\Domain\ValueObject\NameMother;
use App\Tests\Minerva\Shared\Domain\ValueObject\UsernameMother;
use App\Tests\Minerva\Shared\Domain\ValueObject\WebsiteMother;
use Minerva\Posts\Domain\PostAuthor;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use Minerva\Shared\Domain\ValueObject\Email;
use Minerva\Shared\Domain\ValueObject\Name;
use Minerva\Shared\Domain\ValueObject\Username;
use Minerva\Shared\Domain\ValueObject\Website;
use Minerva\Tests\Shared\Domain\ValueObject\EmailMother;

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
