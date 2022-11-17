<?php

declare(strict_types=1);

namespace Auth\Application\User;

use Auth\Domain\User\Email;
use Auth\Domain\User\Password;

final class CreateUserCommand
{
    private function __construct(
        private readonly Email $email,
        private readonly Password $plainPassword,
        private readonly array $roles,
    ) {
    }

    public static function create(
        Email $email,
        Password $plainPassword,
        array $roles,
    ): self {
        return new self(
            $email,
            $plainPassword,
            $roles
        );
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPlainPassword(): Password
    {
        return $this->plainPassword;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
