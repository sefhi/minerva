<?php

declare(strict_types=1);

namespace App\Controller\Auth\Dto;

use Auth\Domain\AccessToken\AccessToken;
use JsonSerializable;

final class AccessTokenDto implements JsonSerializable
{

    private function __construct(
        private readonly string $tokeType,
        private readonly int $expiresIn,
        private readonly string $token,
    ) {
    }

    public static function fromDomain(AccessToken $accessToken) : self {
        return new self(
            $accessToken->getTokeType()->value,
            $accessToken->getExpiresIn(),
            $accessToken->getToken()
        );
    }

    /**
     * @return string
     */
    public function getTokeType(): string
    {
        return $this->tokeType;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }


    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}