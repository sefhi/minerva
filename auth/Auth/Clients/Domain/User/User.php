<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\User;

use Ramsey\Uuid\UuidInterface;

final class User
{

    private function __construct(
        private readonly UuidInterface $id,
        private readonly string $email,
        private readonly string $password,
        private readonly array $roles,
        private readonly bool $active,
    ) {
    }

    public static function create(
        UuidInterface $id,
        string $email,
        string $password,
        array $roles,
        bool $active,
    ): self {
        //TODO encriptar password en valueOBject pasandole instancia de un hasher
        return new self(
            $id,
            $email,
            $password,
            $roles,
            $active,
        );
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
    public function getEmail(): string
    {
        return $this->email;
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