<?php

namespace Auth\Domain\User;

interface PasswordHasher
{
    public function hash(Password $plainPassword): Password;

    public function verify(Password $hashedPassword, Password $plainPassword): bool;
}
