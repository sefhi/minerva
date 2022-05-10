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

        $router = $this->client->getContainer()->get('router');
        $this->client->request(
            'GET',
            $router->generate('posts_find_all')
        );

        // When
        $response = $this->client->getResponse();

        // Then
        self::assertJson($response->getContent());
    }
}
