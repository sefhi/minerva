<?php

declare(strict_types=1);

namespace Minerva\Tests\Posts\Application;

use App\Tests\Minerva\Authors\Domain\AuthorMother;
use Minerva\Authors\Domain\AuthorFinder;
use Minerva\Posts\Application\CreatorPostCommandHandler;
use Minerva\Posts\Domain\Dto\PostCreatorDto;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostRepository;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\Exceptions\AuthorNotFoundException;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreatorPostCommandHandlerTest extends TestCase
{
    private MockObject $repositoryMock;
    private MockObject $authorFinderMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(PostRepository::class);
        $this->authorFinderMock = $this->createMock(AuthorFinder::class);
    }

    /** @test */
    public function itShouldCreatePostAndReturnTrue(): void
    {
        // GIVEN
        $command = CreatorPostCommandMother::random();
        $authorId = new AuthorId($command->getAuthorId());
        $author = AuthorMother::create($authorId);
        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            $authorId
        );

        $this->repositoryMock
            ->expects(self::once())
            ->method('save')
            ->with($postCreatorDto)
            ->willReturn(true);

        $this->authorFinderMock
            ->expects(self::once())
            ->method('__invoke')
            ->with($authorId)
            ->willReturn($author);

        $commandHandler = new CreatorPostCommandHandler($this->repositoryMock, $this->authorFinderMock);

        // WHEN
        $result = $commandHandler($command);

        // THEN
        self::assertTrue($result);
    }

    /** @test */
    public function itShouldNotCreatePostAndReturnFalse(): void
    {

        // GIVEN
        $command = CreatorPostCommandMother::random();
        $authorId = new AuthorId($command->getAuthorId());
        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            $authorId
        );

        $this->repositoryMock
            ->expects(self::never())
            ->method('save');

        $this->authorFinderMock
            ->expects(self::once())
            ->method('__invoke')
            ->with($authorId)
            ->willThrowException(new AuthorNotFoundException($authorId->value()));

        $commandHandler = new CreatorPostCommandHandler($this->repositoryMock, $this->authorFinderMock);

        // THEN
        $this->expectException(AuthorNotFoundException::class);

        // WHEN
        $commandHandler($command);

    }
}
