<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\Criteria\Criteria;

interface PostRepository
{
    /**
     * @return array<Post>
     */
    public function findAll(): array;

    public function save(Post $post): void;

    public function matching(Criteria $criteria): array;
}
