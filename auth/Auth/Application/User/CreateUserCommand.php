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

    /**
     * @return Email
     */
    public function getEmail(): Email
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