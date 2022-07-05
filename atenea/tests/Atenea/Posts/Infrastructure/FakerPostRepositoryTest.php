<?php

declare(strict_types=1);

namespace Atenea\Tests\Posts\Infrastructure;

use Atenea\Posts\Domain\Post;
use Atenea\Posts\Infrastructure\FakerPostRepository;
use Atenea\Tests\Posts\Domain\Dto\PostCreatorDtoMother;
use PHPUnit\Framework\TestCase;

final class FakerPostRepositoryTest extends TestCase
{
    /** @test */
    public function itShouldReturnPostsDomainWhenCallFunctionFindAll(): void
    {
        $fakerPost = new FakerPostRepository();

        $result = $fakerPost->findAll();

        foreach ($result as $post) {
            self::assertInstanceOf(Post::class, $post);
        }
    }

    /** @test */
    public function itShouldSavePostWhenCallFunctionSave(): void
    {
        $postCreatorDto = PostCreatorDtoMother::random();
        $fakerPost = new FakerPostRepository();

        $result = $fakerPost->save($postCreatorDto);

        self::assertTrue($result);
    }
}
