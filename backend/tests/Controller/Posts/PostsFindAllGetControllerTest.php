<?php

namespace App\Tests\Controller\Posts;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostsFindAllGetControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /** @test */
    public function whenCallEndpointPostAllShouldReturnAllPost(): void
    {

        $this->client->request(
            'GET',
            '/posts/all'
        );

        // When
        $response = $this->client->getResponse();
        $result = json_decode($response->getContent(), true);
        // Then
        self::assertResponseIsSuccessful();
        self::assertJson($response->getContent());
        self::assertNotEmpty($result['data']);
    }
}
