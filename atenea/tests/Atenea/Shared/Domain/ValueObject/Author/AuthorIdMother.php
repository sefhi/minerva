<?php

declare(strict_types=1);

namespace Atenea\Tests\Shared\Domain\ValueObject\Author;

use Atenea\Shared\Domain\ValueObject\AuthorId;

final class AuthorIdMother
{
    public static function create(int $value): AuthorId
    {
        return new AuthorId($value);
    }

    public static function random(): AuthorId
    {
        return self::create(random_int(1, 10));
    }
}
