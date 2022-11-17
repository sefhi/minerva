<?php

namespace Tests\Auth\Domain\User;

use Auth\Domain\User\Password;
use Tests\Auth\Shared\Domain\MotherFactory;

class PasswordMother
{
    public static function create(string $value): Password
    {
        return new Password($value);
    }

    public static function plainPassword(): Password
    {
        return self::create(MotherFactory::random()->password());
    }

    public static function passwordEncrypted(): Password
    {
        return self::create(MotherFactory::random()->sha256());
    }
}
