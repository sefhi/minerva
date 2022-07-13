<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Posts\Domain\PostAuthorUsername;
use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Tests\Shared\Domain\ValueObject\UsernameMother;

final class PostAuthorUsernameMother extends UsernameMother
{
    public static function create(string $value): PostAuthorUsername
    {
        return new PostAuthorUsername($value);
    }

    public static function random(): PostAuthorUsername
    {
        return self::create(MotherCreator::random()->userName());
    }
}
