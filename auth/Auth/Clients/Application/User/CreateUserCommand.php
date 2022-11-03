<?php

declare(strict_types=1);

namespace Auth\Clients\Application\User;

use Auth\Clients\Domain\User\Password;

final class CreateUserCommand
{

    public function __construct(
        private readonly string $email,
        private readonly Password $plainPassword,
        private readonly array $roles,
    )
    {
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return Password
     */
    public function getPlainPassword(): Password
    {
        return $this->plainPassword;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

}