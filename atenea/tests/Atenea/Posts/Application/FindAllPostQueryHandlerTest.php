<?php

namespace Atenea\Tests\Posts\Application;

use App\Controller\Posts\Dto\PostResponse;
use Atenea\Posts\Application\FindAllPostQueryHandler;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Tests\Posts\Domain\PostMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindAllPostQueryHandlerTest extends TestCase
{
    private MockObject $repositoryMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(PostRepository::class);
    }

    /** @test */
    public function itShouldReturnAllPost(): void
    {
        $posts = PostMother::array();

        $this->repositoryMock
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($posts);

        $queryHandler = new FindAllPostQueryHandler($this->repositoryMock);
        $resultPosts = ($queryHandler)();

        foreach ($resultPosts->getPosts() as $resultPost) {
            self::assertInstanceOf(PostResponse::class, $resultPost);
        }
    }
}
