<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Application;

use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Posts\Application\CreatorPostCommand;

final class CreatorPostCommandMother
{
    public static function create(string $title, string $content, string $authorId): CreatorPostCommand
    {
        return CreatorPostCommand::fromPrimitive($title, $content, $authorId);
    }

    public static function random(): CreatorPostCommand
    {
        return self::create(
            MotherCreator::random()->text(50),
            MotherCreator::random()->text(500),
            MotherCreator::random()->uuid(),
        );
    }
}
