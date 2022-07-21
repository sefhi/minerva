<?php

declare(strict_types=1);

namespace Atenea\Authors\Infrastructure;

use Atenea\Authors\Domain\Author;
use Atenea\Authors\Domain\AuthorRepository;
use Atenea\Shared\Domain\ValueObject\AuthorId;
use Atenea\Shared\Domain\ValueObject\Email;
use Atenea\Shared\Domain\ValueObject\Name;
use Atenea\Shared\Domain\ValueObject\Username;
use Atenea\Shared\Domain\ValueObject\Website;
use function Lambdish\Phunctional\search;

final class StubAuthorsRepository implements AuthorRepository
{
    private const FILE = __DIR__.'/Stub/users.json';
    private string|bool $stubAuthors;

    public function __construct()
    {
        $this->stubAuthors = file_get_contents(self::FILE);
    }

    public function find(AuthorId $id): ?Author
    {
        $arrAuthors = json_decode(
            $this->stubAuthors,
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        $authorSearched = search(function (array $author) use ($id) {
            return $author['id'] === $id->value();
        }, $arrAuthors);

        if (null === $authorSearched) {
            return null;
        }

        return Author::create(
            $id,
            new Name($authorSearched['name']),
            new Username($authorSearched['username']),
            new Website('https://'.$authorSearched['website']),
            new Email($authorSearched['email']),
        );
    }
}
