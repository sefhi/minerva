<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Token;

use Auth\Clients\Domain\AccessToken\AccessToken;
use Auth\Clients\Domain\AccessToken\CryptKey;
use Auth\Clients\Domain\AccessToken\GenerateToken;
use Auth\Clients\Domain\AccessToken\TokeType;
use Auth\Clients\Domain\Bearer\TokenBearer;
use Auth\Clients\Domain\Token\Token;
use Auth\Clients\Domain\Token\TokenFindRepository;
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
use League\OAuth2\Server\Exception\OAuthServerException;
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

    public function generate(CryptKey $privateKey, Token $token): AccessToken
    {
        $this->configuration = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::plainText($privateKey->getKeyContents(), $privateKey->getPassPhrase()),
            InMemory::plainText('empty', 'empty'),
        );

        $jwtToken = $this->convertToJWT($token);

        return AccessToken::create(TokeType::from('bearer'), $token->getExpiry(), $jwtToken->toString());
    }

    /**
     * Generate a JWT from the access token
     *
     * @param Token $token
     * @return JwtToken
     */
    private function convertToJWT(Token $token): JwtToken
    {
        return $this->configuration->builder()
            ->permittedFor($token->getClient()->getCredentials()->getIdentifier()->value())
            ->identifiedBy($token->getId()->toString())
            ->issuedAt(new DateTimeImmutable())
            ->canOnlyBeUsedAfter(new DateTimeImmutable())
            ->expiresAt($token->getExpiry())
            ->relatedTo((string)$token->getUser()?->getId())
            ->withClaim('scopes', $token->getScopes())
            ->getToken($this->configuration->signer(), $this->configuration->signingKey());
    }

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
        } catch (RequiredConstraintsViolated $exception) {
            throw OAuthServerException::accessDenied('Access token could not be verified');
        }

        $claims = $token->claims();

        return $this->tokenFindRepository->findOrFail(Uuid::fromString($claims->get('jti')));
    }
}