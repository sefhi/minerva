<?php

declare(strict_types=1);

namespace Atenea\Posts\Application;

use JsonSerializable;
use ReturnTypeWillChange;

final class PostAuthorResponse implements JsonSerializable
{
    private function __construct(
        private string $id,
        private string $name,
        private string $username,
        private string $website,
        private string $email,
    ) {
    }

    public static function create(
        string $id,
        string $name,
        string $username,
        string $website,
        string $email,
    ): self {
        return new self(
            $id,
            $name,
            $username,
            $website,
            $email,
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    #[ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
