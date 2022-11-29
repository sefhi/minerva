<?php

namespace App\Tests\Controller\Posts;

use App\Factory\PostFactory;
use App\Factory\PostTitleFactory;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostsGetControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    /** @test */
    public function itShouldSearchByCriteria(): void
    {
        PostFactory::createOne(
            [
                'title' => PostTitleFactory::createOne(
                    [
                        'value' => 'Esto es una prueba',
                    ]
                ),
            ]
        );

        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];

        $this->client->request(
            'GET',
            $router->generate('posts_search'),
            [
                'query' => [
                    'filters' => [
                        'field' => 'title',
                        'value' => 'Esto es una prueba',
                        'operator' => '=',
                    ],
                ],
            ],
            [],
            $server
        );

        // When
        $response = $this->client->getResponse();

        // THEN
        self::assertResponseIsSuccessful();
        self::assertCount(1, json_decode($response->getContent(), true));
    }
}
