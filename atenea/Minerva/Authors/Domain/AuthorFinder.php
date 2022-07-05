<?php

declare(strict_types=1);

namespace Minerva\Authors\Domain;

use Minerva\Shared\Domain\Exceptions\AuthorNotFoundException;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;

class AuthorFinder
{
    public function __construct(private AuthorRepository $repository)
    {
    }

    /**
     * @throws AuthorNotFoundException
     */
    public function __invoke(AuthorId $id): Author
    {
        $author = $this->repository->find($id);

        if (null === $author) {
            throw new AuthorNotFoundException($id->value());
        }

        return $author;
    }
}
