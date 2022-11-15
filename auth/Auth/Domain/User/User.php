<?php

declare(strict_types=1);

namespace Auth\Domain\User;

use Auth\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\UuidInterface;

class User extends AggregateRoot implements UserInterface
{
    public function __construct(
        private UuidInterface $id,
        private readonly Email $email,
        private Password $password,
        private readonly array $roles,
        private readonly bool $active,
    ) {
    }

    public static function create(
        UuidInterface $id,
        Email $email,
        Password $plainPassword,
        array $roles,
    ): self {
        return new self(
            $id,
            $email,
            $plainPassword,
            $roles,
            true,
        );
    }

    public function withPasswordEncrypted(Password $passwordEncrypted): self
    {
        $this->password = $passwordEncrypted;

        return $this;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getId()->toString();
    }
}
