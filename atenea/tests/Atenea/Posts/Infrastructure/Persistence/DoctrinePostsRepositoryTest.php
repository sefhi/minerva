<?php

namespace Atenea\Tests\Posts\Infrastructure\Persistence;

use Atenea\Posts\Domain\Post;
use Atenea\Posts\Infrastructure\Persistence\DoctrinePostsRepository;
use Atenea\Shared\Domain\AggregateRoot;
use Atenea\Tests\Posts\Domain\Dto\PostCreatorDtoMother;
use Atenea\Tests\Posts\Domain\PostAuthorEmailMother;
use Atenea\Tests\Posts\Domain\PostAuthorMother;
use Atenea\Tests\Posts\Domain\PostAuthorNameMother;
use Atenea\Tests\Posts\Domain\PostAuthorUsernameMother;
use Atenea\Tests\Posts\Domain\PostAuthorWebsiteMother;
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

        $doctrinePostsRepository = new DoctrinePostsRepository($this->entityManagerMock);

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
        $postCreatorDtoMother = PostCreatorDtoMother::random();
        $post = PostMother::create(
            $postCreatorDtoMother->getTitle(),
            $postCreatorDtoMother->getContent(),
            PostAuthorMother::create(
                PostAuthorNameMother::random(),
                PostAuthorUsernameMother::random(),
                PostAuthorWebsiteMother::random(),
                PostAuthorEmailMother::random(),
                $postCreatorDtoMother->getAuthorId(),
            )
        );

        $agg = new AggregateRoot();
        // WHEN
        $this->entityManagerMock
            ->expects(self::once())
            ->method('persist')
            ->with($post);
        $this->entityManagerMock
            ->expects(self::once())
            ->method('flush')
            ->with(null);

        // THEN
        $doctrinePostsRepository = new DoctrinePostsRepository($this->entityManagerMock);
        $result = $doctrinePostsRepository->save($postCreatorDtoMother);

        self::assertTrue($result);
    }
}
