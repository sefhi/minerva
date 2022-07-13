<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Posts\Domain\PostAuthorEmail;
use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Tests\Shared\Domain\ValueObject\EmailMother;

final class PostAuthorEmailMother extends EmailMother
{
    public static function create(string $value): PostAuthorEmail
    {
        return new PostAuthorEmail($value);
    }

    public static function random(): PostAuthorEmail
    {
        return self::create(MotherCreator::random()->email());
    }
}
