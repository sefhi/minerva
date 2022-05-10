<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Application;

use Minerva\Posts\Domain\PostRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreatorPostCommandHandlerTest extends TestCase
{
    private PostRepository|MockObject $repositoryMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(PostRepository::class);
    }

    /** @test */
    public function itShouldCreatePostAndReturnTrue(): void
    {
        // Given
        $command = CreatorPostCommandMother::random();

        // WHEN
        $this->repositoryMock
            ->expects(self::once())
            ->method('save')
            ->with(CreatorPostDto::create($command->getTitle(), $command->getContent(), $command->getAuthorId()))
            ->willReturn(true);

        $commandHandler = new CreatorPostCommandHandler($this->repositoryMock);

        self::assertTrue($commandHandler($command));
    }

    /** @test */
    public function itShouldNotCreatePostAndReturnFalse(): void
    {
    }
}
