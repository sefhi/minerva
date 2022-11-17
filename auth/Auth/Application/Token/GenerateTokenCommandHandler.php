<?php

declare(strict_types=1);

namespace Auth\Application\Token;

use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\AccessToken\Strategy\AccessTokenFactory;
use Auth\Domain\Client\ClientFindRepository;
use Auth\Domain\Client\Exception\ClientNotFoundException;

final class GenerateTokenCommandHandler
{
    public function __construct(
        private readonly ClientFindRepository $clientFindRepository,
        private readonly AccessTokenFactory $tokenFactory,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(GenerateTokenCommand $command): AccessToken
    {
        $client = $this->clientFindRepository->findByIdentifier($command->getClientIdentifier());

        if (null === $client) {
            throw ClientNotFoundException::withClientIdentifier($command->getClientIdentifier());
        }

        $client->ensureIsActive();
        $client->ensureGrantSupported($command->getGrant());

        return $this->tokenFactory->getAccessTokenMethod($command->getGrant())->generateAccessToken($command, $client);
    }
}
