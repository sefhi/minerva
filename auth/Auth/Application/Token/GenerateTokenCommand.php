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
        private readonly ?Email $email = null,
        private readonly ?Password $password = null,
        private readonly ?string $refreshToken = null,
    ) {
    }

    public static function create(
        ClientIdentifier $clientIdentifier,
        ClientSecret $clientSecret,
        Grant $grant,
        ?Email $email = null,
        ?Password $password = null,
        ?string $refreshToken = null,
    ): self {
        return new self(
            $clientIdentifier,
            $clientSecret,
            $grant,
            $email,
            $password,
            $refreshToken
        );
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function getPassword(): ?Password
    {
        return $this->password;
    }

    public function getClientIdentifier(): ClientIdentifier
    {
        return $this->clientIdentifier;
    }

    public function getClientSecret(): ClientSecret
    {
        return $this->clientSecret;
    }

    public function getGrant(): Grant
    {
        return $this->grant;
    }
}
