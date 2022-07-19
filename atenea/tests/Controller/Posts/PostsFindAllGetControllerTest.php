<?php

namespace App\Tests\Controller\Posts;

use Atenea\Posts\Domain\PostRepository;
use Atenea\Tests\Posts\Domain\PostMother;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostsFindAllGetControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private MockObject|PostRepository $postRepositoryMock;

    protected function setUp(): void
    {
        $this->client = self::createClient();
        $this->postRepositoryMock = $this->createMock(PostRepository::class);
    }

    /** @test
     * @throws \Exception
     */
    public function whenCallEndpointPostAllShouldReturnAllPost(): void
    {
        $this->postRepositoryMock->expects(self::once())->method('findAll')->willReturn(PostMother::array());


        self::getContainer()->set(PostRepository::class, $this->postRepositoryMock);

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
