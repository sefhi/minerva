<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Application;

use App\Tests\Atenea\Authors\Domain\AuthorMother;
use Atenea\Authors\Domain\AuthorFinder;
use Atenea\Posts\Application\CreatorPostCommandHandler;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Tests\Posts\Domain\PostAuthorMother;
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
        $author = AuthorMother::fromId($authorId);

        $this->repositoryMock
            ->expects(self::once())
            ->method('save')
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
