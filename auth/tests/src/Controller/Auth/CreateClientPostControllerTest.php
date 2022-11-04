<?php

namespace Tests\src\Controller\Auth;

use JsonException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\Auth\Shared\Domain\MotherFactory;

class CreateClientPostControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }


    /** @test
     * @throws JsonException
     */
    public function itShouldCreateClient(): void
    {
        $payload = [
            'name' => MotherFactory::random()->company(),
            'grant' => ['password', 'client_credential']
        ];

        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];

        //When
        $this->client->request(
            'POST',
            $router->generate('auth_client'),
            [],
            [],
            $server,
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        $response = $this->client->getResponse();

        //Then
        self::assertResponseIsSuccessful();
    }
}
