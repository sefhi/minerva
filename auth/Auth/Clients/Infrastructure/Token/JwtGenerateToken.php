<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Token;

use Auth\Clients\Domain\AccessToken\AccessToken;
use Auth\Clients\Domain\AccessToken\CryptKey;
use Auth\Clients\Domain\AccessToken\GenerateToken;
use Auth\Clients\Domain\AccessToken\TokeType;
use Auth\Clients\Domain\Token;
use DateTimeImmutable;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token as JwtToken;

final class JwtGenerateToken implements GenerateToken
{

    /**
     * @var Configuration
     */
    private Configuration $configuration;

    public function generate(CryptKey $privateKey, Token $token): AccessToken
    {
        $this->configuration = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::plainText($privateKey->getKeyContents(), $privateKey->getPassPhrase()),
            InMemory::plainText('empty', 'empty'),
        );

        $token = $this->convertToJWT($token);

        return AccessToken::create(TokeType::from('bearer'), new DateTimeImmutable(), $token->toString());
    }

    /**
     * Generate a JWT from the access token
     *
     * @param Token $token
     * @return JwtToken
     */
    private function convertToJWT(Token $token) : JwtToken
    {
        return $this->configuration->builder()
            ->permittedFor($token->getClient()->getCredentials()->getIdentifier()->value())
            ->identifiedBy($token->getId()->toString())
            ->issuedAt(new DateTimeImmutable())
            ->canOnlyBeUsedAfter(new DateTimeImmutable())
            ->expiresAt($token->getExpiry())
            ->relatedTo((string) $token->getUser())
            ->withClaim('scopes', $token->getScopes())
            ->getToken($this->configuration->signer(), $this->configuration->signingKey());
    }
}