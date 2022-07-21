<?php

declare(strict_types=1);

namespace App\Tests\Atenea\Authors\Domain;

use Atenea\Authors\Application\AuthorFinder;
use Atenea\Authors\Domain\AuthorRepository;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

final class AuthorFinderTest extends TestCase
{
    use Factories;
    private MockObject $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(AuthorRepository::class);
    }

    /** @test */
    public function itShouldReturnAndAuthor(): void
    {
        // Given
        $authorId = AuthorIdMother::random();
        $author = AuthorMother::create($authorId);

        $this->repository
            ->expects(self::once())
            ->method('find')
            ->with($authorId)
            ->willReturn($author);

        $authorFinder = new AuthorFinder($this->repository);

        // When
        $result = ($authorFinder)($authorId);

        // Then
        self::assertSame($author, $result);
    }

    /** @test */
    public function itShouldThrowAndAuthorNotFoundExceptionWhenNotFindAuthor(): void
    {
        // Then
        $this->expectExceptionCode(AuthorNotFoundException::class);
        $this->expectExceptionCode(404);

        // Given
        $authorId = AuthorIdMother::random();

        $this->repository
            ->expects(self::once())
            ->method('find')
            ->with($authorId)
            ->willReturn(null);

        $authorFinder = new AuthorFinder($this->repository);

        // When
        ($authorFinder)($authorId);
    }
}
