<?php

declare(strict_types=1);

namespace Atenea\Authors\Application;

use Atenea\Authors\Domain\Author;
use Atenea\Authors\Domain\AuthorRepository;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\AuthorId;

class AuthorFinder
{
    public function __construct(private readonly AuthorRepository $repository)
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
