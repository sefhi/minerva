<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Application;

use Minerva\Posts\Application\CreatorPostCommandHandler;
use Minerva\Posts\Domain\Dto\PostCreatorDto;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostRepository;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
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
        // GIVEN
        $command = CreatorPostCommandMother::random();
        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            new AuthorId($command->getAuthorId())
        );

        // WHEN
        $this->repositoryMock
            ->expects(self::once())
            ->method('save')
            ->with($postCreatorDto)
            ->willReturn(true);

        $commandHandler = new CreatorPostCommandHandler($this->repositoryMock);
        $result = $commandHandler($command);

        // THEN
        self::assertTrue($result);
    }

    /** @test */
    public function itShouldNotCreatePostAndReturnFalse(): void
    {
        // GIVEN
        $command = CreatorPostCommandMother::random();
        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            new AuthorId($command->getAuthorId())
        );

        // WHEN
        $this->repositoryMock
            ->expects(self::once())
            ->method('save')
            ->with($postCreatorDto)
            ->willReturn(false);

        $commandHandler = new CreatorPostCommandHandler($this->repositoryMock);
        $result = $commandHandler($command);

        // THEN
        self::assertFalse($result);
    }
}
