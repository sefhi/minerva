<?php

declare(strict_types=1);

namespace App\Tests\Atenea\Authors\Infrastructure;

use Atenea\Authors\Infrastructure\StubAuthorsRepository;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use PHPUnit\Framework\TestCase;

final class StubAuthorsRepositoryTest extends TestCase
{
    /** @test */
    public function itShouldReturnAuthorWhenCallFindByAuthorId(): void
    {
        // Given
        $authorId = AuthorIdMother::create('098782d1-c76e-3dea-9ab7-aecb6681e88d');

        $repository = new StubAuthorsRepository();

        $result = $repository->find($authorId);

        self::assertSame($authorId, $result->getId());
    }

    /** @test */
    public function itShouldNutWhenUserIdNotExist(): void
    {
        // Given
        $authorId = AuthorIdMother::random();

        $repository = new StubAuthorsRepository();

        // When
        $result = $repository->find($authorId);

        // Then
        self::assertNull($result);
    }
}
