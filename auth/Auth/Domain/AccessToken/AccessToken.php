<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken;

use Auth\Domain\RefreshToken\RefreshToken;
use DateTimeImmutable;

final class AccessToken
{
    private function __construct(
        private readonly TokeType $tokeType,
        private readonly DateTimeImmutable $expiresIn,
        private readonly string $token,
        private readonly ?RefreshToken $refreshToken = null,
    ) {
    }

    public static function create(
        TokeType $tokeType,
        DateTimeImmutable $expiresIn,
        string $token,
        ?RefreshToken $refreshToken = null,
    ): self {
        return new self(
            $tokeType,
            $expiresIn,
            $token,
            $refreshToken
        );
    }

    /**
     * @return RefreshToken|null
     */
    public function getRefreshToken(): ?RefreshToken
    {
        return $this->refreshToken;
    }


    /**
     * @return TokeType
     */
    public function getTokeType(): TokeType
    {
        return $this->tokeType;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn->getTimestamp();
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }


}
