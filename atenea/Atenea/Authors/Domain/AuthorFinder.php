<?php

declare(strict_types=1);

namespace Atenea\Authors\Domain;

use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

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
