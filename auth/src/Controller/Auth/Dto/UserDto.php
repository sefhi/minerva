<?php

declare(strict_types=1);

namespace App\Controller\Auth\Dto;

use Auth\Domain\User\User;

final class UserDto implements \JsonSerializable
{
    private function __construct(
        private readonly string $id,
        private readonly string $email,
        private readonly string $password,
        private readonly array $roles = [],
    ) {
    }

    public static function createFromUser(
        User $user
    ): self {
        return new self(
            (string) $user->getId(),
            (string) $user->getEmail(),
            (string) $user->getPassword(),
            $user->getRoles()
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'roles' => array_map(static fn ($rol) => $rol->value(), $this->getRoles()),
        ];
    }
}
