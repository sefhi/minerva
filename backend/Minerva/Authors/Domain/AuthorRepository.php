<?php

declare(strict_types=1);

namespace Minerva\Authors\Domain;

use Minerva\Shared\Domain\ValueObject\Author\AuthorId;

interface AuthorRepository
{
    public function find(AuthorId $id): ?Author;
}
