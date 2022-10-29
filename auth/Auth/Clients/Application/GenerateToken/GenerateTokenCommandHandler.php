<?php

declare(strict_types=1);

namespace Auth\Clients\Application\GenerateToken;

use Auth\Clients\Domain\AccessToken\AccessToken;
use Auth\Clients\Domain\AccessToken\CryptKeyPrivate;
use Auth\Clients\Domain\AccessToken\GenerateToken;
use Auth\Clients\Domain\ClientFindRepository;
use Auth\Clients\Domain\Token;
use Auth\Clients\Domain\TokenSaveRepository;
use Ramsey\Uuid\Uuid;

final class GenerateTokenCommandHandler
{

    public function __construct(
        private readonly ClientFindRepository $clientFindRepository,
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly GenerateToken $generateToken,
    ) {
    }

    public function __invoke(GenerateTokenCommand $command): AccessToken
    {
        $client = $this->clientFindRepository->findByIdentifier($command->getClientIdentifier());

        if (null === $client) {
            //TODO exception
            throw new \RuntimeException('Client not found');
        }

        if (!$this->clientFindRepository->validateClient(
            $command->getClientIdentifier(),
            $command->getClientSecret(),
            $command->getGrant()
        )) {
            //TODO exception
            throw new \RuntimeException('Client is not valid');
        }

        //TODO
        $date = new \DateTimeImmutable();
        $expiredAt = $date->add(new \DateInterval('PT2H'));
        $token = Token::create(
            Uuid::uuid4(),
            $client,
            $expiredAt,
            false
        );

        $this->tokenSaveRepository->save($token);

        return $this->generateToken->generate(
            CryptKeyPrivate::create($command->getPrivateKey()),
            $token
        );
    }
}