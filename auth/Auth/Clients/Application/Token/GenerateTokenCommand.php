<?php

declare(strict_types=1);

namespace Auth\Clients\Application\Token;

use Auth\Clients\Domain\Client\ClientIdentifier;
use Auth\Clients\Domain\Client\ClientSecret;
use Auth\Clients\Domain\Client\Grant;

final class GenerateTokenCommand
{
    private function __construct(
        private readonly ClientIdentifier $clientIdentifier,
        private readonly ClientSecret $clientSecret,
        private readonly Grant $grant,
        private readonly string $privateKey,
        private readonly string $publicKey,
        private readonly ?string $username = null,
        private readonly ?string $password = null,
    ) {
    }

    public static function create(
        ClientIdentifier $clientIdentifier,
        ClientSecret $clientSecret,
        Grant $grant,
        string $privateKey,
        string $publicKey,
        ?string $username = null,
        ?string $password = null,
    ): self {
        return new self(
            $clientIdentifier,
            $clientSecret,
            $grant,
            $privateKey,
            $publicKey,
            $username,
            $password
        );
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
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