<?php

namespace Tests\Auth\Domain\User;

use Auth\Domain\User\Email;
use Auth\Domain\User\Password;
use Tests\Auth\Domain\User\PasswordMother;

use Auth\Domain\User\User;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Tests\Auth\Shared\Domain\MotherFactory;

final class UserMother
{
    public static function create(
        UuidInterface $id,
        Email $email,
        Password $password,
        array $roles,
    ): User {
        return User::create($id, $email, $password, $roles);
    }

    public static function random(): User
    {
        return self::create(
            Uuid::fromString(MotherFactory::random()->uuid()),
            EmailMother::random(),
            PasswordMother::passwordEncrypted(),
            []
        );
    }
}
