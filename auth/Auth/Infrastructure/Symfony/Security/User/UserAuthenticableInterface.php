<?php

namespace Auth\Infrastructure\Symfony\Security\User;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserAuthenticableInterface extends UserInterface
{
    public function getId(): UuidInterface;
}
