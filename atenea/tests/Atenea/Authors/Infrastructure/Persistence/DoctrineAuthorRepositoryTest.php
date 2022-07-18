<?php

declare(strict_types=1);

namespace App\Tests\Atenea\Authors\Infrastructure\Persistence;

use App\Tests\Atenea\Authors\Domain\AuthorMother;
use Atenea\Authors\Infrastructure\Persistence\DoctrineAuthorRepository;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class DoctrineAuthorRepositoryTest extends TestCase
{
    private MockObject|EntityRepository $repositoryMock;
    private MockObject|EntityManagerInterface $entityManagerMock;

    protected function setUp(): void
    {
        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $this->repositoryMock = $this->createMock(EntityRepository::class);
    }

    /**
     * @test
     */
    public function itShouldFindAuthorById(): void
    {
        // GIVEN
        $authorId = AuthorIdMother::random();
        $author = AuthorMother::fromId($authorId);

        $this->repositoryMock
            ->expects(self::once())
            ->method('find')
            ->with($authorId)
            ->willReturn($author);
        $this->entityManagerMock
            ->expects(self::once())
            ->method('getRepository')
            ->willReturn($this->repositoryMock);

        $repository = new DoctrineAuthorRepository($this->entityManagerMock);
        $result = $repository->find($authorId);

        self::assertEquals($author, $result);
    }
}
