<?php

declare(strict_types=1);

namespace Minerva\Posts\Infrastructure;

use Minerva\Posts\Domain\Dto\PostCreatorDto;
use Minerva\Posts\Domain\Post;
use Minerva\Posts\Domain\PostAuthor;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostId;
use Minerva\Posts\Domain\PostRepository;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use Minerva\Shared\Domain\ValueObject\Email;
use Minerva\Shared\Domain\ValueObject\Name;
use Minerva\Shared\Domain\ValueObject\Username;
use Minerva\Shared\Domain\ValueObject\Website;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\search;

final class StubPostRepository implements PostRepository
{
    /**
     * @throws \JsonException
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
                $this->getAuthor($post['userId'])
            );
        }, $resultPost);
    }

    public function save(PostCreatorDto $dto): bool
    {
        // TODO: Implement save() method.
        return true;
    }

    private function getAuthor(int $userId): PostAuthor
    {
        $jsonFile = file_get_contents('/var/www/html/Minerva/Posts/Infrastructure/Stub/users.json');

        $resultUsers = json_decode($jsonFile, true, 512, JSON_THROW_ON_ERROR);

        $userSearched = search(function (array $user) use ($userId) {
            return $user['id'] === $userId;
        }, $resultUsers);

        return PostAuthor::create(
            new AuthorId($userSearched['id']),
            new Name($userSearched['name']),
            new Username($userSearched['username']),
            new Website('https://'.$userSearched['website']),
            new Email($userSearched['email']),
        );
    }
}
