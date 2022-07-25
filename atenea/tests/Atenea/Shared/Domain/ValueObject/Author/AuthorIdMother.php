<?php

declare(strict_types=1);

namespace Atenea\Tests\Shared\Domain\ValueObject\Author;

use Atenea\Shared\Domain\ValueObject\AuthorId;
use Atenea\Tests\Shared\Domain\MotherCreator;

final class AuthorIdMother
{
    public static function create(string $value): AuthorId
    {
        return new AuthorId($value);
    }

    public static function random(): AuthorId
    {
        return self::create(MotherCreator::random()->uuid());
    }
}
