<?php

declare(strict_types=1);

namespace Atenea\Posts\Infrastructure;

use Atenea\Authors\Application\AuthorFinder;
use Atenea\Authors\Domain\Author;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostAuthor;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostId;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\AuthorId;
use Atenea\Shared\Domain\ValueObject\Email;
use Atenea\Shared\Domain\ValueObject\Name;
use Atenea\Shared\Domain\ValueObject\Username;
use Atenea\Shared\Domain\ValueObject\Website;
use Atenea\Tests\Shared\Domain\MotherCreator;
use JsonException;
use function Lambdish\Phunctional\map;

final class StubPostRepository implements PostRepository
{
    private const FILE = __DIR__.'/Stub/posts.json';

    public function __construct(private readonly AuthorFinder $authorFinder)
    {
    }

    /**
     * @throws JsonException
     */
    public function findAll(): array
    {
        $jsonFile = file_get_contents(self::FILE);

        $resultPost = json_decode(
            $jsonFile,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        return map(function (array $post) {
            return Post::create(
                new PostId($post['id']),
                new PostTitle($post['title']),
                new PostContent($post['body']),
                $this->getAuthor(new AuthorId($post['userId'])),
            );
        }, $resultPost);
    }

    /**
     * @throws JsonException
     */
    public function save(PostCreatorDto $dto): bool
    {
        Post::create(
            $dto->getId(),
            $dto->getTitle(),
            $dto->getContent(),
            $dto->getAuthor(),
        );

        return true;
    }

    /**
     * @throws AuthorNotFoundException
     */
    private function getAuthor(AuthorId $id): PostAuthor
    {
        $author = ($this->authorFinder)($id);

        return PostAuthor::create(
            $author->getId(),
            new Name($author->getName()->value()),
            new Username($author->getUsername()->value()),
            new Website($author->getWebsite()->value()),
            new Email($author->getEmail()->value()),
        );
    }
}
