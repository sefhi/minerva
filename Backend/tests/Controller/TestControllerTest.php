<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testUnit(): void
    {
        $this->client->request(
            'GET',
            'test',
        );

        self::assertResponseIsSuccessful();
    }
}
