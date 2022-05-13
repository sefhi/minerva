<?php

declare(strict_types=1);

namespace Minerva\Posts\Infrastructure;

use JsonException;
use Minerva\Posts\Domain\Dto\PostCreatorDto;
use Minerva\Posts\Domain\Post;
use Minerva\Posts\Domain\PostAuthor;
use Minerva\Posts\Domain\PostAuthorNotFoundException;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostId;
use Minerva\Posts\Domain\PostRepository;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use Minerva\Shared\Domain\ValueObject\Email;
use Minerva\Shared\Domain\ValueObject\Name;
use Minerva\Shared\Domain\ValueObject\Username;
use Minerva\Shared\Domain\ValueObject\Website;
use Minerva\Tests\Shared\Domain\MotherCreator;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\search;

final class StubPostRepository implements PostRepository
{
    /**
     * @throws JsonException
     */
    public function findAll(): array
    {
        $jsonFile = file_get_contents('/var/www/html/Minerva/Posts/Infrastructure/Stub/posts.json');

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
     * @throws PostAuthorNotFoundException
     * @throws JsonException
     */
    private function getAuthor(AuthorId $userId): PostAuthor
    {
        $jsonFile = file_get_contents('/var/www/html/Minerva/Posts/Infrastructure/Stub/users.json');

        $resultUsers = json_decode($jsonFile, true, 512, JSON_THROW_ON_ERROR);

        $userSearched = search(function (array $user) use ($userId) {
            return $user['id'] === $userId->value();
        }, $resultUsers);

        if (null === $userSearched) {
            throw new PostAuthorNotFoundException($userId->value());
        }

        return PostAuthor::create(
            new AuthorId($userSearched['id']),
            new Name($userSearched['name']),
            new Username($userSearched['username']),
            new Website('https://'.$userSearched['website']),
            new Email($userSearched['email']),
        );
    }
}
