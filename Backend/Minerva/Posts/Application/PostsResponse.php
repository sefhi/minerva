<?php

declare(strict_types=1);

namespace Minerva\Posts\Application;

use JsonSerializable;

final class PostsResponse implements JsonSerializable
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

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
