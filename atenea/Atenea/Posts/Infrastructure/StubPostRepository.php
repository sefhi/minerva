<?php

declare(strict_types=1);

namespace Atenea\Posts\Infrastructure;

use Atenea\Authors\Application\AuthorFinder;
use Atenea\Authors\Domain\Author;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostId;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
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
                new PostTitle($post['title']),
                new PostContent($post['body']),
                new AuthorId($post['userId']),
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
            $dto->getAuthor()->getId(),
            new PostId(MotherCreator::random()->numberBetween()),
        );

        return true;
    }

    /**
     * @throws AuthorNotFoundException
     */
    private function getAuthor(AuthorId $id): Author
    {
        return ($this->authorFinder)($id);
    }
}
