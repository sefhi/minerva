<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Token;

use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\AccessToken\CryptKey;
use Auth\Domain\AccessToken\GenerateToken;
use Auth\Domain\AccessToken\TokeType;
use Auth\Domain\Bearer\TokenBearer;
use Auth\Domain\Exception\OAuthServerException;
use Auth\Domain\RefreshToken\RefreshToken;
use Auth\Domain\Token\Token;
use Auth\Domain\Token\TokenFindRepository;
use DateTimeImmutable;
use DateTimeZone;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token as JwtToken;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\StrictValidAt;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Ramsey\Uuid\Uuid;

use function class_exists;
use function date_default_timezone_get;

final class JwtGenerateToken implements GenerateToken
{


    /**
     * @var Configuration
     */
    private Configuration $configuration;


    public function __construct(private readonly TokenFindRepository $tokenFindRepository)
    {
    }

    public function generateAccessToken(CryptKey $privateKey, Token $token, ?RefreshToken $refreshToken): AccessToken
    {
        $this->configuration = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::plainText($privateKey->getKeyContents(), $privateKey->getPassPhrase()),
            InMemory::plainText('empty', 'empty'),
        );

        $jwtToken = $this->convertTokenToJWT($token);

        if (null !== $refreshToken) {

            $jwtRefreshToken = $this->convertRefreshTokenToJWT($refreshToken);

            return AccessToken::createWithRefreshToken(
                TokeType::from('bearer'),
                $token->getExpiry(),
                $jwtToken->toString(),
                $jwtRefreshToken->toString()
            );
        }

        return AccessToken::create(TokeType::from('bearer'), $token->getExpiry(), $jwtToken->toString());
    }

    /**
     * Generate a JWT from the access token
     *
     * @param Token $token
     * @return JwtToken
     */
    private function convertTokenToJWT(Token $token): JwtToken
    {
        return $this->configuration->builder()
            ->permittedFor((string)$token->getClient()->getCredentials()->getIdentifier())
            ->identifiedBy((string)$token->getId())
            ->issuedAt(new DateTimeImmutable())
            ->canOnlyBeUsedAfter(new DateTimeImmutable())
            ->expiresAt($token->getExpiry())
            ->relatedTo((string)$token->getUser()?->getId())
            ->withClaim('scopes', $token->getScopes())
            ->getToken($this->configuration->signer(), $this->configuration->signingKey());
    }

    /**
     * Generate a JWT from the access token
     *
     * @param RefreshToken $refreshToken
     * @return JwtToken
     */
    private function convertRefreshTokenToJWT(RefreshToken $refreshToken): JwtToken
    {
        return $this->configuration->builder()
            ->permittedFor((string)$refreshToken->getToken()->getClient()->getIdentifier())
            ->identifiedBy((string)$refreshToken->getId())
            ->issuedAt(new DateTimeImmutable())
            ->canOnlyBeUsedAfter(new DateTimeImmutable())
            ->expiresAt($refreshToken->getExpiry())
            ->relatedTo((string)$refreshToken->getToken()->getUser()?->getId())
            ->withClaim('scopes', $refreshToken->getToken()->getScopes())
            ->getToken($this->configuration->signer(), $this->configuration->signingKey());
    }

    /**
     * @throws OAuthServerException
     */
    public function generateTokenByBearer(CryptKey $publicKey, TokenBearer $tokenBearer): Token
    {
        $this->configuration = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('empty', 'empty')
        );

        $this->configuration->setValidationConstraints(
            class_exists(StrictValidAt::class)
                ? new StrictValidAt(new SystemClock(new DateTimeZone(date_default_timezone_get())))
                : new LooseValidAt(new SystemClock(new DateTimeZone(date_default_timezone_get()))),
            new SignedWith(
                new Sha256(),
                InMemory::plainText($publicKey->getKeyContents(), $publicKey->getPassPhrase() ?? '')
            )
        );

        // Attempt to parse the JWT
        $token = $this->configuration->parser()->parse($tokenBearer->value());

        try {
            // Attempt to validate the JWT
            $constraints = $this->configuration->validationConstraints();
            $this->configuration->validator()->assert($token, ...$constraints);
        } catch (RequiredConstraintsViolated) {
            throw OAuthServerException::accessDenied('Access token could not be verified');
        }

        $claims = $token->claims();

        $tokenDomainFound = $this->tokenFindRepository->findOrFail(Uuid::fromString($claims->get('jti')));

        if ($tokenDomainFound->isRevoked()) {
            throw OAuthServerException::accessDenied('Access token has been revoked');
        }

        return $this->tokenFindRepository->findOrFail(Uuid::fromString($claims->get('jti')));
    }
}
