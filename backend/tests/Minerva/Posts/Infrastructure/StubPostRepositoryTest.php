<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Infrastructure;

use Minerva\Posts\Domain\Post;
use Minerva\Posts\Infrastructure\StubPostRepository;
use PHPUnit\Framework\TestCase;

final class StubPostRepositoryTest extends TestCase
{

    /** @test */
    public function itShouldReturnPostDomainWhenCallFunctionFindAll(): void
    {
        $fakerPost = new StubPostRepository();

        $result = $fakerPost->findAll();

        foreach ($result as $post) {
            self::assertInstanceOf(Post::class, $post);
        }
    }
}
