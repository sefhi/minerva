<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Domain;

use Atenea\Posts\Domain\PostAuthorWebsite;
use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Tests\Shared\Domain\ValueObject\WebsiteMother;

final class PostAuthorWebsiteMother extends WebsiteMother
{
    public static function create(string $value): PostAuthorWebsite
    {
        return new PostAuthorWebsite($value);
    }

    public static function random(): PostAuthorWebsite
    {
        return self::create(MotherCreator::random()->url());
    }
}
