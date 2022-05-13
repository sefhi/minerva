<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Infrastructure;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Minerva\Posts\Domain\Post;
use Minerva\Posts\Infrastructure\GuzzleApiPostStubRepository;
use PHPUnit\Framework\TestCase;

final class GuzzleApiPostStubRepositoryTest extends TestCase
{

    /** @test */
    public function itShouldReturnPostDomainWhenCallFunctionFindAll(): void
    {
        // Given
        $bodyPosts = Utils::streamFor(file_get_contents('https://jsonplaceholder.typicode.com/posts'));

        $mock = new MockHandler(
            [
                new Response(200, [], $bodyPosts),
            ]
        );

        $handlerStack = HandlerStack::create($mock);
        $guzzleMock = new Client(
            [
                'handler' => $handlerStack,
            ]
        );

        $repository = new GuzzleApiPostStubRepository($guzzleMock, '');

        // When
        $result = $repository->findAll();

        // Then
        foreach ($result as $post) {
            self::assertInstanceOf(Post::class, $post);
        }
    }
}
