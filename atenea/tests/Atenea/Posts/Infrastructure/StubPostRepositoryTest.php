<?php

declare(strict_types=1);

namespace App\Tests\Atenea\Posts\Infrastructure;

use App\Tests\Atenea\Authors\Domain\AuthorMother;
use Atenea\Authors\Domain\AuthorFinder;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Infrastructure\StubPostRepository;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Tests\Posts\Domain\Dto\PostCreatorDtoMother;
use Atenea\Tests\Posts\Domain\PostContentMother;
use Atenea\Tests\Posts\Domain\PostTitleMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class StubPostRepositoryTest extends TestCase
{
    private MockObject $authorFinderMock;

    protected function setUp(): void
    {
        $this->authorFinderMock = $this->createMock(AuthorFinder::class);
    }

    /** @test */
    public function itShouldReturnPostDomainWhenCallFunctionFindAll(): void
    {
        $this->authorFinderMock
            ->method('__invoke')
            ->willReturn(AuthorMother::create());

        $stubRepository = new StubPostRepository($this->authorFinderMock);

        $result = $stubRepository->findAll();

        foreach ($result as $post) {
            self::assertInstanceOf(Post::class, $post);
        }
    }

    /** @test */
    public function itShouldSavePostWhenCallFunctionSave(): void
    {
        $this->authorFinderMock
            ->expects(self::once())
            ->method('__invoke')
            ->willReturn(AuthorMother::create());

        $postCreatorDto = PostCreatorDtoMother::random();
        $stubRepository = new StubPostRepository($this->authorFinderMock);

        $result = $stubRepository->save($postCreatorDto);

        self::assertTrue($result);
    }

    /** @test */
    public function itShouldThrowAAuthorNotFoundExceptionWhenSearchByAuthorIdThatNotExists(): void
    {
        // Given
        $authorId = new AuthorId(60);
        $postCreatorDto = PostCreatorDtoMother::create(
            PostTitleMother::random(),
            PostContentMother::random(),
            $authorId
        );

        $this->authorFinderMock
            ->expects(self::once())
            ->method('__invoke')
            ->willThrowException(new AuthorNotFoundException($authorId->value()));

        $stubRepository = new StubPostRepository($this->authorFinderMock);

        // Then
        $this->expectException(AuthorNotFoundException::class);
        $this->expectExceptionCode(404);

        // When
        $stubRepository->save($postCreatorDto);
    }
}
