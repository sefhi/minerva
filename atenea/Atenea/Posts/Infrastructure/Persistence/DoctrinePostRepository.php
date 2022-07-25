<?php

declare(strict_types=1);

namespace Atenea\Posts\Infrastructure\Persistence;

use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Shared\Infrastructure\Persistence\DoctrineRepository;

final class DoctrinePostRepository extends DoctrineRepository implements PostRepository
{
    /**
     * @return array<int, Post>
     */
    public function findAll(): array
    {
        return $this->getRepository(Post::class)->findAll();
    }

    public function save(PostCreatorDto $dto): bool
    {
        $post = Post::create($dto->getId(), $dto->getTitle(), $dto->getContent(), $dto->getAuthor());
        $this->persist($post);

        return true;
    }
}
