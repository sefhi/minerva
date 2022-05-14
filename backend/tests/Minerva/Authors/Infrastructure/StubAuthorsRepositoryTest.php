<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Authors\Infrastructure;

use Minerva\Authors\Infrastructure\StubAuthorsRepository;
use Minerva\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use PHPUnit\Framework\TestCase;

final class StubAuthorsRepositoryTest extends TestCase
{
    /** @test */
    public function itShouldReturnAuthorWhenCallFindByAuthorId(): void
    {
        // Given
        $authorId = AuthorIdMother::create(1);

        $repository = new StubAuthorsRepository();

        $result = $repository->find($authorId);

        self::assertSame($authorId, $result->getId());
    }

    /** @test */
    public function itShouldNutWhenUserIdNotExist(): void
    {
        // Given
        $authorId = AuthorIdMother::create(100);

        $repository = new StubAuthorsRepository();

        // When
        $result = $repository->find($authorId);

        // Then
        self::assertNull($result);
    }


}
