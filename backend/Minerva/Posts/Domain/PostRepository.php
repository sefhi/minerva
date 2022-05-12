<?php

declare(strict_types=1);

namespace Minerva\Posts\Domain;

use Minerva\Posts\Domain\Dto\PostCreatorDto;

interface PostRepository
{
    /**
     * @return Post[]
     */
    public function findAll(): array;

    public function save(PostCreatorDto $dto): bool;
}
