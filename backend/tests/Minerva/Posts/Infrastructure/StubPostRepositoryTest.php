<?php

declare(strict_types=1);

namespace App\Tests\Minerva\Posts\Infrastructure;

use Minerva\Posts\Domain\Post;
use Minerva\Posts\Domain\PostAuthorNotFoundException;
use Minerva\Posts\Infrastructure\StubPostRepository;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use Minerva\Tests\Posts\Domain\Dto\PostCreatorDtoMother;
use Minerva\Tests\Posts\Domain\PostContentMother;
use Minerva\Tests\Posts\Domain\PostTitleMother;
use Minerva\Tests\Shared\Domain\MotherCreator;
use Minerva\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use PHPUnit\Framework\TestCase;

final class StubPostRepositoryTest extends TestCase
{

    /** @test */
    public function itShouldReturnPostDomainWhenCallFunctionFindAll(): void
    {
        $stubRepository = new StubPostRepository();

        $result = $stubRepository->findAll();

        foreach ($result as $post) {
            self::assertInstanceOf(Post::class, $post);
        }
    }

    /** @test */
    public function itShouldSavePostWhenCallFunctionSave(): void
    {
        $postCreatorDto = PostCreatorDtoMother::random();
        $stubRepository = new StubPostRepository();

        $result = $stubRepository->save($postCreatorDto);

        self::assertTrue($result);
    }

    /** @test */
    public function itShouldThrowAPostAuthorNotFoundExceptionWhenSeachByAuthorIdThatNotExists(): void
    {
        $this->expectException(PostAuthorNotFoundException::class);
        $this->expectExceptionCode(404);

        $postCreatorDto = PostCreatorDtoMother::create(
            PostTitleMother::random(),
            PostContentMother::random(),
            new AuthorId(60)
        );

        $stubRepository = new StubPostRepository();
        $stubRepository->save($postCreatorDto);
    }


}
