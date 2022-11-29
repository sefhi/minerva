<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Application;

use Atenea\Posts\Application\Create\CreatorPostCommand;
use Atenea\Tests\Shared\Domain\MotherCreator;

final class CreatorPostCommandMother
{
    public static function create(string $id, string $title, string $content, string $authorId): CreatorPostCommand
    {
        return CreatorPostCommand::fromPrimitive($id, $title, $content, $authorId);
    }

    public static function random(): CreatorPostCommand
    {
        return self::create(
            MotherCreator::random()->uuid(),
            MotherCreator::random()->text(50),
            MotherCreator::random()->text(500),
            MotherCreator::random()->uuid(),
        );
    }
}
