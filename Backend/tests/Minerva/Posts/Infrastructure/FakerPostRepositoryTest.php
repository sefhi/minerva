<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Infrastructure;

use Minerva\Posts\Domain\Post;
use Minerva\Posts\Infrastructure\FakerPostRepository;
use PHPUnit\Framework\TestCase;

final class FakerPostRepositoryTest extends TestCase
{
    /** @test */
    public function itShouldReturnPostsDomain(): void
    {
        $fakerPost = new FakerPostRepository();

        $result = $fakerPost->findAll();

        foreach ($result as $post) {
            self::assertInstanceOf(Post::class, $post);
        }
    }
}
