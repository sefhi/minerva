<?php

namespace Minerva\Tests\Posts\Application;

use App\Tests\Minerva\Posts\Domain\PostMother;
use Minerva\Posts\Application\FindAllPostQueryHandler;
use Minerva\Posts\Application\PostResponse;
use Minerva\Posts\Domain\PostRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindAllPostQueryHandlerTest extends TestCase
{
    private MockObject|PostRepository $repositoryMock;

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
