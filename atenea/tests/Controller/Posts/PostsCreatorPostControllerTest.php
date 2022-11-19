<?php

namespace App\Tests\Controller\Posts;

use App\Factory\AuthorFactory;
use Atenea\Authors\Domain\Author;
use Atenea\Tests\Posts\Domain\PostIdMother;
use Atenea\Tests\Shared\Domain\MotherCreator;
use Atenea\Tests\Shared\Domain\ValueObject\Author\AuthorIdMother;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostsCreatorPostControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /** @test
     * @throws \JsonException
     */
    public function shouldCreatePostWithEmptyContentAndReturnStatusCode201(): void
    {
        /** @var Author $author */
        $author = AuthorFactory::createOne()->object();
        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];

        $this->client->request(
            'POST',
            $router->generate('post_creator'),
            [],
            [],
            $server,
            $this->getPayload($author)
        );

        // When
        $response = $this->client->getResponse();

        // Then
        self::assertResponseIsSuccessful();
        self::assertEmpty(json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR));
    }

    /** @test
     * @throws \JsonException
     */
    public function itShouldReturnErrorValidateFieldsAndReturnStatusCode400(): void
    {
        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];

        $this->client->request(
            'POST',
            $router->generate('post_creator'),
            [],
            [],
            $server,
            $this->requestJsonErrorValidate()
        );

        // When
        $response = $this->client->getResponse();

        // Then
        self::assertResponseStatusCodeSame(400);
        self::assertJson($response->getContent());
    }

    /**
     * @throws \JsonException
     */
    private function getPayload(Author $author): string
    {
        return json_encode([
            'id' => PostIdMother::random()->value(),
            'title' => MotherCreator::random()->text(50),
            'content' => MotherCreator::random()->paragraph(2),
            'authorId' => (string) $author->getId(),
        ], JSON_THROW_ON_ERROR);
    }

    /**
     * @throws \JsonException
     */
    private function requestJsonErrorValidate(): string
    {
        return json_encode([
            'id' => PostIdMother::random()->value(),
            'title' => MotherCreator::random()->text(500),
            'content' => MotherCreator::random()->text(20000),
            'authorId' => AuthorIdMother::random()->value(),
        ], JSON_THROW_ON_ERROR);
    }
}
