<?php

declare(strict_types=1);

namespace Atenea\Posts\Infrastructure;

use Exception;
use Faker\Factory;
use Faker\Generator;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostId;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

final class FakerPostRepository implements PostRepository
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }

    /**
     * {@inheritDoc}
     */
    public function findAll(): array
    {
        return $this->toResponse();
    }

    /**
     * @return array<Post>
     *
     * @throws Exception
     */
    private function toResponse(): array
    {
        $posts = [];
        $limit = 10;

        for ($i = 0; $i < $limit; ++$i) {
            $posts[] = Post::create(
                new PostTitle($this->faker->realText(50)),
                new PostContent($this->faker->paragraph(random_int(1, 3))),
                new AuthorId((int) $this->faker->numerify()),
                new PostId((int) $this->faker->numerify())
            );
        }

        return $posts;
    }

    public function save(PostCreatorDto $dto): bool
    {
        Post::create(
            $dto->getTitle(),
            $dto->getContent(),
            $dto->getAuthor()->getId(),
            new PostId(random_int(1, 100)),
        );

        return true;
    }
}
