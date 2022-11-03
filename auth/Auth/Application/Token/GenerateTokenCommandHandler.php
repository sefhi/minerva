<?php

declare(strict_types=1);

namespace Auth\Application\Token;

use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\AccessToken\CryptKeyPrivate;
use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\Client\ClientFindRepository;
use Auth\Domain\Client\Grant;
use Auth\Domain\Token\Token;
use Auth\Domain\Token\TokenSaveRepository;
use Auth\Domain\User\PasswordHasher;
use Auth\Domain\User\UserFindRepository;
use Ramsey\Uuid\Uuid;

final class GenerateTokenCommandHandler
{

    public function __construct(
        private readonly ClientFindRepository $clientFindRepository,
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly GenerateToken $generateToken,
        private readonly UserFindRepository $userFindRepository,
        //TODO quitar y refactorizar esto
        private readonly PasswordHasher $passwordHasher,
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

        if( Grant::PASSWORD === $command->getGrant() ) {

            $user = $this->userFindRepository->findOneByEmailOrFail($command->getUsername());

            $isValidPassword = $this->passwordHasher
                ->verify($user->getPassword(), $command->getPassword());

            if(!$isValidPassword) {
                throw new \RuntimeException('user credentials not valid');
            }

            $token = Token::createWithUser(
                Uuid::uuid4(),
                $client,
                $expiredAt,
                $user,
                false
            );

            $this->tokenSaveRepository->save($token);

        } else {
            $token = Token::create(
                Uuid::uuid4(),
                $client,
                $expiredAt,
                false
            );

            $this->tokenSaveRepository->save($token);
        }


        return $this->generateToken->generate(
            CryptKeyPrivate::create($command->getPrivateKey()),
            $token
        );
    }
}