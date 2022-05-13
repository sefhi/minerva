<?php

declare(strict_types=1);

namespace Minerva\Posts\Infrastructure;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
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
use Psr\Http\Message\ResponseInterface;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\search;

final class GuzzleApiPostStubRepository implements PostRepository
{
    private const ENDPOINT_POSTS = '/posts';


    public function __construct(private Client $client, private string $baseUrlPostStub)
    {
    }

    /**
     * @throws GuzzleHttpClientException
     */
    public function findAll(): array
    {
        try {
            $method = 'GET';
            $options = $this->buildOptions($method);
            $url = $this->baseUrlPostStub.self::ENDPOINT_POSTS;
            $response = $this->getRequest($method, $url, $options);

            $resultPost = json_decode(
                $response->getBody()->getContents(),
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
        } catch (GuzzleException|JsonException $exception) {
            throw new GuzzleHttpClientException($exception->getMessage());
        }
    }

    public function save(PostCreatorDto $dto): bool
    {
        // TODO: Implement save() method.
        return true;
    }

    /**
     * @throws GuzzleException
     * @throws GuzzleHttpClientException
     */
    private function getRequest(string $method, string $url, array $options): ResponseInterface
    {
        $response = $this->client->request($method, $url, $options);
        if (200 !== $response->getStatusCode()) {
            throw new GuzzleHttpClientException('An error has occurred');
        }

        return $response;
    }

    private function getAuthor(int $userId): PostAuthor
    {
        try {
            $jsonFile = file_get_contents('https://jsonplaceholder.typicode.com/users');

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
        } catch (JsonException $exception) {
            throw new GuzzleHttpClientException($exception->getMessage());
        }
    }

    /**
     * @throws JsonException
     */
    private function buildOptions(string $method, ?array $query = null): array
    {
        $options = [
            'http_errors' => false,
        ];

        if ('GET' === $method) {
            $options['query'] = $query;
        }

        if ('POST' === $method) {
            $options['body'] = json_encode($query, JSON_THROW_ON_ERROR);
        }

        return $options;
    }
}
