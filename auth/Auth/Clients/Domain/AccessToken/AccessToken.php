<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\AccessToken;

use DateTimeImmutable;

final class AccessToken
{
    private function __construct(
        private readonly TokeType $tokeType,
        private readonly DateTimeImmutable $expiresIn,
        private readonly string $token,
    ) {
    }

    public static function create(
        TokeType $tokeType,
        DateTimeImmutable $expiresIn,
        string $token,
    ): self {
        return new self(
            $tokeType,
            $expiresIn,
            $token
        );
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
