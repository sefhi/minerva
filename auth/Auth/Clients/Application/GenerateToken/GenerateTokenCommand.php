<?php

declare(strict_types=1);

namespace Auth\Clients\Application\GenerateToken;

use Auth\Clients\Domain\ClientIdentifier;
use Auth\Clients\Domain\ClientSecret;
use Auth\Clients\Domain\Grant;

final class GenerateTokenCommand
{
    private function __construct(
        private readonly ClientIdentifier $clientIdentifier,
        private readonly ClientSecret $clientSecret,
        private readonly Grant $grant,
        private readonly string $privateKey,
        private readonly string $publicKey,
    ) {
    }

    public static function create(
        ClientIdentifier $clientIdentifier,
        ClientSecret $clientSecret,
        Grant $grant,
        string $privateKey,
        string $publicKey,
    ): self {
        return new self(
            $clientIdentifier,
            $clientSecret,
            $grant,
            $privateKey,
            $publicKey,
        );
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