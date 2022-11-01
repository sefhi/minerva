<?php

namespace Auth\Clients\Domain\User;

interface PasswordHasher
{
    public function hash(User $user, string $plainPassword): Password;

    public function isValid(User $user, Password $password): bool;
}