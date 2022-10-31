<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\User;

use Ramsey\Uuid\UuidInterface;

final class User
{

    public function __construct(
        private readonly UuidInterface $id,
        private readonly string $username,
        private readonly string $password,
        private readonly array $roles,
        private readonly bool $active,
    )
    {
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

}