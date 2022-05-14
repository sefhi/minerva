<?php

declare(strict_types=1);

namespace Minerva\Authors\Infrastructure;

use Minerva\Authors\Domain\Author;
use Minerva\Authors\Domain\AuthorRepository;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use Minerva\Shared\Domain\ValueObject\Email;
use Minerva\Shared\Domain\ValueObject\Name;
use Minerva\Shared\Domain\ValueObject\Username;
use Minerva\Shared\Domain\ValueObject\Website;
use function Lambdish\Phunctional\search;

final class StubAuthorsRepository implements AuthorRepository
{
    private const FILE = '/var/www/html/Minerva/Posts/Infrastructure/Stub/users.json';
    private array $stubAuthors;

    public function __construct()
    {
        $this->stubAuthors = json_decode(
            file_get_contents(self::FILE),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
    }

    public function find(AuthorId $id): ?Author
    {
        $authorSearched = search(function (array $author) use ($id) {
            return $author['id'] === $id->value();
        }, $this->stubAuthors);

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
