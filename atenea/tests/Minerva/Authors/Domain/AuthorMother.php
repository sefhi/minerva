<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Authors\Domain;

use Minerva\Authors\Domain\Author;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use Minerva\Shared\Domain\ValueObject\Email;
use Minerva\Shared\Domain\ValueObject\Name;
use Minerva\Shared\Domain\ValueObject\Username;
use Minerva\Shared\Domain\ValueObject\Website;
use Minerva\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Minerva\Tests\Shared\Domain\ValueObject\EmailMother;
use Minerva\Tests\Shared\Domain\ValueObject\NameMother;
use Minerva\Tests\Shared\Domain\ValueObject\UsernameMother;
use Minerva\Tests\Shared\Domain\ValueObject\WebsiteMother;

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
}
