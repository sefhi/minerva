<?php

declare(strict_types=1);

namespace Minerva\Posts\Application;

final class PostsResponse
{
    private array $posts;

    private function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    public static function create(array $posts): self
    {
        return new self($posts);
    }

    /**
     * @return PostResponse[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }
}
