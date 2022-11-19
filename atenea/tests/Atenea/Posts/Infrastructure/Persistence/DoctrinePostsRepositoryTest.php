<?php

namespace Atenea\Tests\Posts\Infrastructure\Persistence;

use Atenea\Posts\Domain\Post;
use Atenea\Posts\Infrastructure\Persistence\DoctrinePostRepository;
use Atenea\Tests\Posts\Domain\PostMother;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class DoctrinePostsRepositoryTest extends TestCase
{
    private EntityManagerInterface|MockObject $entityManagerMock;
    private ObjectRepository|MockObject $repositoryMock;

    protected function setUp(): void
    {
        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $this->repositoryMock = $this->createMock(EntityRepository::class);
    }

    /**
     * @test
     */
    public function itShouldFindAllPost(): void
    {
        // GIVEN
        $posts = PostMother::array();

        // WHEN
        $this->repositoryMock
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($posts);
        $this->entityManagerMock
            ->expects(self::once())
            ->method('getRepository')
            ->with(Post::class)
            ->willReturn($this->repositoryMock);

        $doctrinePostsRepository = new DoctrinePostRepository($this->entityManagerMock);

        $result = $doctrinePostsRepository->findAll();

        // THEN
        self::assertCount(count($posts), $result);
        foreach ($result as $post) {
            self::assertInstanceOf(Post::class, $post);
        }
    }

    /**
     * @test
     */
    public function itShouldSavePost(): void
    {
        // GIVEN
        $post = PostMother::random();

        // WHEN
        $this->entityManagerMock
            ->expects(self::once())
            ->method('persist');
        $this->entityManagerMock
            ->expects(self::once())
            ->method('flush');

        // THEN
        $doctrinePostsRepository = new DoctrinePostRepository($this->entityManagerMock);
        $doctrinePostsRepository->save($post);
    }
}
