<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Application;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
use Minerva\Posts\Application\CreatorPostCommand;

final class CreatorPostCommandMother
{
    public static function create(string $title, string $content, int $authorId): CreatorPostCommand
    {
        return CreatorPostCommand::fromPrimitive($title, $content, $authorId);
    }

    public static function random(): CreatorPostCommand
    {
        return self::create(
            MotherCreator::random()->text(50),
            MotherCreator::random()->text(500),
            random_int(1, 100),
        );
    }
}
