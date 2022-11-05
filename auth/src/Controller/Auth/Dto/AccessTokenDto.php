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
        private readonly string $accessToken,
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
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }


    public function jsonSerialize(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'token_type' => $this->getTokeType(),
            'expires_in' => $this->getExpiresIn()
        ];
    }
}