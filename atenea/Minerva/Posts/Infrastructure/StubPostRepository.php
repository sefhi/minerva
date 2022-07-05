<?php

declare(strict_types=1);

namespace Minerva\Posts\Infrastructure;

use JsonException;
use Minerva\Authors\Domain\AuthorFinder;
use Minerva\Posts\Domain\Dto\PostCreatorDto;
use Minerva\Posts\Domain\Post;
use Minerva\Posts\Domain\PostAuthor;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostId;
use Minerva\Posts\Domain\PostRepository;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\Exceptions\AuthorNotFoundException;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use Minerva\Tests\Shared\Domain\MotherCreator;
use function Lambdish\Phunctional\map;

final class StubPostRepository implements PostRepository
{
    private const FILE = '/var/www/html/Minerva/Posts/Infrastructure/Stub/posts.json';

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
                new PostId($post['id']),
                new PostTitle($post['title']),
                new PostContent($post['body']),
                $this->getAuthor(new AuthorId($post['userId']))
            );
        }, $resultPost);
    }

    /**
     * @throws JsonException
     */
    public function save(PostCreatorDto $dto): bool
    {
        Post::create(
            new PostId(MotherCreator::random()->numberBetween()),
            $dto->getTitle(),
            $dto->getContent(),
            $this->getAuthor($dto->getAuthorId())
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
            $author->getName(),
            $author->getUsername(),
            $author->getWeb(),
            $author->getEmail(),
        );
    }
}
