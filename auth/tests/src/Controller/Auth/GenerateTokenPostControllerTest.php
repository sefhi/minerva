<?php

namespace Tests\src\Controller\Auth;

use App\Factory\ClientFactory;
use App\Factory\PasswordFactory;
use App\Factory\RefreshTokenFactory;
use App\Factory\TokenFactory;
use App\Factory\UserFactory;
use Auth\Domain\Client\Grant;
use Auth\Domain\RefreshToken\RefreshToken;

class GenerateTokenPostControllerTest extends AbstractWebTestCase
{

    /** @test */
    public function itShouldGenerateTokenWithClientCredentials(): void
    {
        // GIVEN
        $client = ClientFactory::new()->withGrantClientCredentials()->create();
        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];
        $parameters = [
            'client_id' => (string)$client->getCredentials()->getIdentifier(),
            'client_secret' => (string)$client->getCredentials()->getSecret(),
            'grant_type' => Grant::CLIENT_CREDENTIALS->value,
        ];

        // WHEN
        $this->client->request(
            'POST',
            $router->generate('auth_token'),
            $parameters,
            [],
            $server,
        );

        // THEN
        self::assertResponseIsSuccessful();
    }

    /** @test */
    public function itShouldGenerateTokenWithPassword(): void
    {
        // GIVEN
        $client = ClientFactory::new()->withGrantPassword()->create();
        $user = UserFactory::createOne();
        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];
        $parameters = [
            'client_id' => (string)$client->getCredentials()->getIdentifier(),
            'client_secret' => (string)$client->getCredentials()->getSecret(),
            'grant_type' => Grant::PASSWORD->value,
            'username' => $user->getEmail()->value(),
            'password' => PasswordFactory::PASSWORD,
        ];

        // WHEN
        $this->client->request(
            'POST',
            $router->generate('auth_token'),
            $parameters,
            [],
            $server,
        );

        // THEN
        self::assertResponseIsSuccessful();
    }

    /** @test */
    public function itShouldGenerateTokenWithRefreshToken(): void
    {
        // GIVEN
        $user  = UserFactory::createOne();
        $token = TokenFactory::new()->withUser($user->object())->create();
        $refreshToken = RefreshTokenFactory::new()->withToken($token->object())->create();

        $router = $this->client->getContainer()->get('router');
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];
        $parameters = [
            'client_id' => (string)$token->getClient()->getCredentials()->getIdentifier(),
            'client_secret' => (string)$token->getClient()->getCredentials()->getSecret(),
            'grant_type' => Grant::REFRESH_TOKEN->value,
            'username' => $user->getEmail()->value(),
            'password' => PasswordFactory::PASSWORD,
            'refresh_token' => (string)$refreshToken->getId()
        ];

        // WHEN
        $this->client->request(
            'POST',
            $router->generate('auth_token'),
            $parameters,
            [],
            $server,
        );

        // THEN
        self::assertResponseIsSuccessful();
    }
}
