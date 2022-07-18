<?php

namespace App\Tests\Controller\Posts;

use Atenea\Tests\Shared\Domain\MotherCreator;
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
        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];
        $this->client->request(
            'POST',
            $router->generate('post_creator'),
            [],
            [],
            $server,
            $this->requestJson()
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

    private function requestJson(): string
    {
        return json_encode([
            'title' => MotherCreator::random()->text(50),
            'content' => MotherCreator::random()->paragraph(2),
            'authorId' => 1,
        ], JSON_THROW_ON_ERROR);
    }

    private function requestJsonErrorValidate(): string
    {
        return json_encode([
            'title' => MotherCreator::random()->text(500),
            'content' => MotherCreator::random()->text(20000),
            'authorId' => random_int(1, 10),
        ], JSON_THROW_ON_ERROR);
    }
}
