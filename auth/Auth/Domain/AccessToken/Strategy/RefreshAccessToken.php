<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken\Strategy;

use Auth\Application\Token\GenerateTokenCommand;
use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\AccessToken\CryptKeyPrivate;
use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\Client\Client;
use Auth\Domain\RefreshToken\RefreshToken;
use Auth\Domain\RefreshToken\RefreshTokenFindRepository;
use Auth\Domain\RefreshToken\RefreshTokenSaveRepository;
use Auth\Domain\Token\Token;
use Auth\Domain\Token\TokenSaveRepository;
use Auth\Domain\User\PasswordHasher;
use Auth\Domain\User\UserFindRepository;
use Auth\Shared\Domain\Exception\InvalidDataException;
use Ramsey\Uuid\Uuid;

final class RefreshAccessToken implements AccessTokenMethod
{

    public function __construct(
        private readonly TokenSaveRepository $tokenSaveRepository,
        private readonly GenerateToken $generateToken,
        private readonly UserFindRepository $userFindRepository,
        private readonly PasswordHasher $passwordHasher,
        private readonly RefreshTokenFindRepository $refreshTokenFindRepository,
        private readonly RefreshTokenSaveRepository $refreshTokenSaveRepository,
    )
    {
    }

    public function generateAccessToken(GenerateTokenCommand $command, Client $client): AccessToken
    {

        if (null === $command->getRefreshToken()) {
            throw InvalidDataException::parameterRequired('refresh_token');
        }

        $refreshToken = $command->getRefreshToken();
        //TODO validamos el refresh_token encrypt/decrypt

        $refreshToken = $this->refreshTokenFindRepository->findOrFail(Uuid::fromString($refreshToken));
        $token = $refreshToken->getToken();

        //Expire old tokens
        $refreshToken->revoke();
        $token->revoke();

        $this->refreshTokenSaveRepository->save($refreshToken);
        $this->tokenSaveRepository->save($token);

        //Generate new tokens
        $user = $this->userFindRepository->findOneByEmailOrFail($command->getEmail());

        $isValidPassword = $this->passwordHasher
            ->verify($user->getPassword(), $command->getPassword());

        if (!$isValidPassword) {
            throw new \RuntimeException('user credentials not valid');
        }

        /**
         * TODO TOKEN
         */

        $token = Token::createWithUser(
            Uuid::uuid4(),
            $client,
            $user,
            false
        );

        $this->tokenSaveRepository->save($token);


        /**
         * TODO REFRESH TOKEN
         */

        $refreshToken = RefreshToken::create(
            Uuid::uuid4(),
            $token,
            false,
        );

        $this->refreshTokenSaveRepository->save($refreshToken);

        return $this->generateToken->generateAccessToken(
            CryptKeyPrivate::create($command->getPrivateKey()),
            $token,
            $refreshToken
        );
    }
}