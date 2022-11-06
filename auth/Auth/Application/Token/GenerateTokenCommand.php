<?php

declare(strict_types=1);

namespace Auth\Application\Token;

use Auth\Domain\Client\ClientIdentifier;
use Auth\Domain\Client\ClientSecret;
use Auth\Domain\Client\Grant;
use Auth\Domain\User\Email;
use Auth\Domain\User\Password;

final class GenerateTokenCommand
{
    private function __construct(
        private readonly ClientIdentifier $clientIdentifier,
        private readonly ClientSecret $clientSecret,
        private readonly Grant $grant,
        private readonly string $privateKey,
        private readonly string $publicKey,
        private readonly ?Email $email = null,
        private readonly ?Password $password = null,
        private readonly ?string $refreshToken = null,
    ) {
    }

    public static function create(
        ClientIdentifier $clientIdentifier,
        ClientSecret $clientSecret,
        Grant $grant,
        string $privateKey,
        string $publicKey,
        ?Email $email = null,
        ?Password $password = null,
        ?string $refreshToken = null,
    ): self {
        return new self(
            $clientIdentifier,
            $clientSecret,
            $grant,
            $privateKey,
            $publicKey,
            $email,
            $password,
            $refreshToken
        );
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }


    /**
     * @return Email|null
     */
    public function getEmail(): ?Email
    {
        return $this->email;
    }

    /**
     * @return Password|null
     */
    public function getPassword(): ?Password
    {
        return $this->password;
    }

    /**
     * @return ClientIdentifier
     */
    public function getClientIdentifier(): ClientIdentifier
    {
        return $this->clientIdentifier;
    }

    /**
     * @return ClientSecret
     */
    public function getClientSecret(): ClientSecret
    {
        return $this->clientSecret;
    }

    /**
     * @return Grant
     */
    public function getGrant(): Grant
    {
        return $this->grant;
    }

    /**
     * @return string
     */
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }


}
