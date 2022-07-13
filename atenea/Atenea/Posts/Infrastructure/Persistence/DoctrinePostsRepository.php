<?php

declare(strict_types=1);

namespace Atenea\Posts\Infrastructure\Persistence;

use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostAuthor;
use Atenea\Posts\Domain\PostAuthorEmail;
use Atenea\Posts\Domain\PostAuthorName;
use Atenea\Posts\Domain\PostAuthorUsername;
use Atenea\Posts\Domain\PostAuthorWebsite;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrinePostsRepository extends DoctrineRepository implements PostRepository
{
    public function findAll(): array
    {
        return $this->getRepository(Post::class)->findAll();
    }

    public function save(PostCreatorDto $dto): bool
    {

        //TODO  esta parte hay que eliminarla. El dto ya tiene o debe devolver los datos del author
        $author = PostAuthor::create(
            new PostAuthorName('Test'),
            new PostAuthorUsername('TEssadasd'),
            new PostAuthorWebsite('https://google.es'),
            new PostAuthorEmail('test@test.es'),
            $dto->getAuthorId()
        );
        $post = Post::create($dto->getTitle(), $dto->getContent(), $author);
        $this->persist($post);
        return true;
    }
}
