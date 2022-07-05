<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Posts\Domain\Dto\PostCreatorDto;

interface PostRepository
{
    /**
     * @return array<Post>
     */
    public function findAll(): array;

    public function save(PostCreatorDto $dto): bool;
}
