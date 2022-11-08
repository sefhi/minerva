<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken\Strategy;

use Auth\Application\Token\GenerateTokenCommand;
use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\AccessToken\CryptKeyPrivate;
use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\Client\Client;
use Auth\Domain\RefreshToken\RefreshToken;
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
        private readonly RefreshTokenSaveRepository $refreshTokenSaveRepository,
    )
    {
    }

    public function generateAccessToken(GenerateTokenCommand $command, Client $client): AccessToken
    {

        if (null === $command->getRefreshToken()) {
            throw InvalidDataException::parameterRequired('refresh_token');
        }

        $token = $command->getRefreshToken();

        $refreshTokenDomain = $this->generateToken->generateRefreshTokenFromJwtToken($token);

        $tokenDomain = $refreshTokenDomain->getToken();

        //Expire old tokens
        $refreshTokenDomain->revoke();
        $tokenDomain->revoke();

        $this->refreshTokenSaveRepository->save($refreshTokenDomain);
        $this->tokenSaveRepository->save($tokenDomain);

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

        $tokenDomain = Token::createWithUser(
            Uuid::uuid4(),
            $client,
            $user,
            false
        );

        $this->tokenSaveRepository->save($tokenDomain);


        /**
         * TODO REFRESH TOKEN
         */

        $refreshTokenDomain = RefreshToken::create(
            Uuid::uuid4(),
            $tokenDomain,
            false,
        );

        $this->refreshTokenSaveRepository->save($refreshTokenDomain);

        return $this->generateToken->generateAccessToken(
            $tokenDomain,
            $refreshTokenDomain
        );
    }
}