<?php

namespace App\Tests\Controller\Posts;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostsCreatorPostControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /**
     * @test
     */
    public function shouldCreatePostAndReturn201(): void
    {
        // Given
        $this->client->request(
            'POST',
            'post',
            [
                'title' => 'This is title',
                'content' => 'This is content',
                'userId' => 1,
            ],
        );

        // When
        $response = $this->client->getResponse();

        // Then
        self::assertResponseIsSuccessful();
        self::assertEmpty(json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR));
    }
}
