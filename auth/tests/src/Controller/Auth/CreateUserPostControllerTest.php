<?php

namespace Tests\src\Controller\Auth;

use App\Controller\Auth\CreateUserPostController;
use App\Factory\UserFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\Auth\Shared\Domain\MotherFactory;

class CreateUserPostControllerTest extends AbstractWebTestCase
{
    /** @test */
    public function itShouldCreateUser(): void
    {
        $user = UserFactory::createOne();
        $payload = [
            'email' => MotherFactory::random()->email(),
            'password' => MotherFactory::random()->password()
        ];

        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];

        //When
        $this->client->request(
            'POST',
            $router->generate('auth_user'),
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
