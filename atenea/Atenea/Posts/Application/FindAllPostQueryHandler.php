<?php

declare(strict_types=1);

namespace Atenea\Posts\Application;

use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostRepository;

final class FindAllPostQueryHandler
{
    /**
     * @param PostRepository $repository
     */
    public function __construct(private readonly PostRepository $repository)
    {
    }

    public function __invoke(): PostsResponse
    {
        $posts = $this->repository->findAll();

        return PostsResponse::create(
            array_map(
                static fn (Post $post) => PostResponse::create(
                    $post->getId()->value(),
                    $post->getTitle()->value(),
                    $post->getContent()->value(),
                    $post->getAuthorId()->value()
                ),
                $posts
            )
        );
    }
}
