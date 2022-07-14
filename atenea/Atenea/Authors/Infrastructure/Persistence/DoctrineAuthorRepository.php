<?php

declare(strict_types=1);

namespace Atenea\Authors\Infrastructure\Persistence;

use Atenea\Authors\Domain\Author;
use Atenea\Authors\Domain\AuthorRepository;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineAuthorRepository extends DoctrineRepository implements AuthorRepository
{
    public function find(AuthorId $id): ?Author
    {
        $author = $this->getRepository(Author::class)->find($id);

        return $author ?? null;
    }
}
