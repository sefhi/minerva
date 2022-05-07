<?php

declare(strict_types=1);

namespace Minerva\Posts\Domain;

interface PostRepository
{
    /**
     * @return Post[]
     */
    public function findAll(): array;
}
