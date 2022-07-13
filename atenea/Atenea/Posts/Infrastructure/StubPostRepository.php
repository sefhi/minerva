<?php

declare(strict_types=1);

namespace Atenea\Posts\Infrastructure;

use Atenea\Posts\Domain\PostAuthorEmail;
use Atenea\Posts\Domain\PostAuthorName;
use Atenea\Posts\Domain\PostAuthorUsername;
use Atenea\Posts\Domain\PostAuthorWebsite;
use JsonException;
use Atenea\Authors\Domain\AuthorFinder;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostAuthor;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostId;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Tests\Shared\Domain\MotherCreator;
use function Lambdish\Phunctional\map;

final class StubPostRepository implements PostRepository
{
    private const FILE = '/var/www/html/Atenea/Posts/Infrastructure/Stub/posts.json';

    public function __construct(private AuthorFinder $authorFinder)
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
                new PostTitle($post['title']),
                new PostContent($post['body']),
                $this->getAuthor(new AuthorId($post['userId'])),
                new PostId($post['id'])
            );
        }, $resultPost);
    }

    /**
     * @throws JsonException
     */
    public function save(PostCreatorDto $dto): bool
    {
        Post::create(
            $dto->getTitle(),
            $dto->getContent(),
            $this->getAuthor($dto->getAuthorId()),
            new PostId(MotherCreator::random()->numberBetween()),
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
            new PostAuthorName($author->getName()->value()),
            new PostAuthorUsername($author->getUsername()->value()),
            new PostAuthorWebsite($author->getWeb()->value()),
            new PostAuthorEmail($author->getEmail()->value()),
        );
    }
}
