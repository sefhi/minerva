<?php

namespace App\Tests\Controller\Posts;

use App\Tests\Minerva\Shared\Domain\MotherCreator;
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
        $router = $this->client->getContainer()->get('router');
        $this->client->request(
            'POST',
            $router->generate('post_creator'),
            [
                'title' => MotherCreator::random()->text(50),
                'content' => MotherCreator::random()->paragraph(2),
                'authorId' => random_int(1, 1000),
            ],
        );

        // When
        $response = $this->client->getResponse();

        // Then
        self::assertResponseIsSuccessful();
        self::assertEmpty(json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR));
    }
}
