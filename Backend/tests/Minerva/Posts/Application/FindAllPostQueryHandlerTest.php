<?php

namespace Minerva\Tests\Posts\Application;

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
        $postResponses = PostResponsesMother::random();

        $this->repositoryMock
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($postResponses);

        $queryHandler = new FindAllPostQueryHandler($this->repositoryMock);
        $resultPosts = ($queryHandler)();

        foreach ($resultPosts as $resultPost) {
            self::assertInstanceOf(PostResponse::class, $resultPost);
        }
    }
}
