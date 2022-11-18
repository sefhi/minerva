<?php

declare(strict_types=1);

namespace App\Controller\Posts\Dto;

use JsonSerializable;
use ReturnTypeWillChange;

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

    #[ReturnTypeWillChange]
 public function jsonSerialize(): array
 {
     return get_object_vars($this);
 }
}
