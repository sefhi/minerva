<?php

namespace Tests\Auth\Application\Client;

use Auth\Application\Client\CreateClientCommand;
use Auth\Application\Client\CreateClientCommandHandler;
use Auth\Domain\Client\ClientSaveRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tests\Auth\Domain\Client\ClientMother;

class CreateClientCommandHandlerTest extends TestCase
{
    /**
     * @var ClientSaveRepository|MockObject
     */
    private MockObject|ClientSaveRepository $clientSaveRepositoryMock;

    protected function setUp(): void
    {
        $this->clientSaveRepositoryMock = $this->createMock(ClientSaveRepository::class);
    }


    /** @test
     *
     * @throws Exception
     */
    public function itShouldSaveClient(): void
    {
        //GIVEN
        $client = ClientMother::random();
        $command = CreateClientCommand::create(
            $client->getCredentials()->getName(),
            $client->getGrants(),
        );

        //WHEN
        $this->clientSaveRepositoryMock
            ->expects(self::once())
            ->method('save');

        $commandHandler = new CreateClientCommandHandler($this->clientSaveRepositoryMock);

        //THEN
        ($commandHandler)($command);
    }
}
