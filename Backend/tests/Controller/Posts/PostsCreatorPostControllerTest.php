<?php

namespace App\Tests\Controller\Posts;

use Minerva\Tests\Shared\Domain\MotherCreator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostsCreatorPostControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /** @test */
    public function shouldCreatePostAndReturn201(): void
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

    private function requestJson(): string
    {
        return json_encode([
            'title' => MotherCreator::random()->text(300),
            'content' => MotherCreator::random()->paragraph(2),
            'authorId' => random_int(1, 1000),
        ], JSON_THROW_ON_ERROR);
    }
}
