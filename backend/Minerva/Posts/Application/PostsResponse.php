<?php

declare(strict_types=1);

namespace Minerva\Posts\Application;

use JsonSerializable;

final class PostsResponse implements JsonSerializable
{
    /**
     * @var array<PostResponse>
     */
    private array $posts;

    /**
     * @param array<PostResponse> $posts
     */
    private function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @param array<PostResponse> $posts
     *
     * @return PostsResponse
     */
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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}