<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Symfony\Hasher;

use Auth\Clients\Domain\User\Password;
use Auth\Clients\Domain\User\PasswordHasher;
use Auth\Clients\Domain\User\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

final class SymfonyPasswordHasher implements PasswordHasher
{


    public function __construct(private readonly PasswordHasherFactoryInterface $passwordHasherFactory,)
    {
    }

    public function hash(Password $plainPassword): Password
    {
        return Password::fromString($this->passwordHasherFactory
            ->getPasswordHasher(UserInterface::class)
            ->hash((string)$plainPassword));
    }

    public function verify(Password $hashedPassword, Password $plainPassword): bool
    {
        return $this->passwordHasherFactory
            ->getPasswordHasher(UserInterface::class)
            ->verify($hashedPassword->value(),$plainPassword->value());
    }
}