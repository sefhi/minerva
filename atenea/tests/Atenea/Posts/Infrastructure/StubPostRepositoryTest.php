<?php

declare(strict_types=1);

namespace App\Tests\Atenea\Posts\Infrastructure;

use App\Tests\Atenea\Authors\Domain\AuthorMother;
use Atenea\Authors\Domain\AuthorFinder;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Infrastructure\StubPostRepository;
use Atenea\Tests\Posts\Domain\Dto\PostCreatorDtoMother;
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
        $postCreatorDto = PostCreatorDtoMother::random();
        $stubRepository = new StubPostRepository($this->authorFinderMock);

        $result = $stubRepository->save($postCreatorDto);

        self::assertTrue($result);
    }
}
