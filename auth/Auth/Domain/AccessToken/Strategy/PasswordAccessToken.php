<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken\Strategy;

use Auth\Application\Token\GenerateTokenCommand;
use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\AccessToken\CryptKeyPrivate;
use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\Client\Client;
use Auth\Domain\Token\Token;
use Auth\Domain\Token\TokenSaveRepository;
use Auth\Domain\User\PasswordHasher;
use Auth\Domain\User\UserFindRepository;
use Ramsey\Uuid\Uuid;

final class PasswordAccessToken implements AccessTokenMethod
{

    public function __construct(
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly GenerateToken $generateToken,
        private readonly UserFindRepository $userFindRepository,
        private readonly PasswordHasher $passwordHasher,
    )
    {
    }

    public function generateAccessToken(GenerateTokenCommand $command, Client $client): AccessToken
    {
        $user = $this->userFindRepository->findOneByEmailOrFail($command->getEmail());

        $isValidPassword = $this->passwordHasher
            ->verify($user->getPassword(), $command->getPassword());

        if(!$isValidPassword) {
            throw new \RuntimeException('user credentials not valid');
        }

        $date = new \DateTimeImmutable();
        $expiredAt = $date->add(new \DateInterval('PT2H'));

        $token = Token::createWithUser(
            Uuid::uuid4(),
            $client,
            $expiredAt,
            $user,
            false
        );

        $this->tokenSaveRepository->save($token);

        return $this->generateToken->generateAccessToken(
            CryptKeyPrivate::create($command->getPrivateKey()),
            $token
        );
    }
}