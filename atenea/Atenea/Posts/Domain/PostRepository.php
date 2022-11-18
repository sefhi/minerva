<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

interface PostRepository
{
    /**
     * @return array<Post>
     */
    public function findAll(): array;

    public function save(Post $post): void;
}
