<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Application;

use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Posts\Application\PostAuthorResponse;

final class PostAuthorResponseMother
{
    public static function create(
        int $id,
        string $name,
        string $username,
        string $website,
        string $email
    ): PostAuthorResponse {
        return PostAuthorResponse::create(
            $id,
            $name,
            $username,
            $website,
            $email
        );
    }

    public static function random(): PostAuthorResponse
    {
        return self::create(
            random_int(1, 1000),
            MotherCreator::random()->name(),
            MotherCreator::random()->userName(),
            MotherCreator::random()->domainName(),
            MotherCreator::random()->email(),
        );
    }
}
