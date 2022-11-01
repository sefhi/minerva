<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Symfony\Security;

use Auth\Clients\Domain\User\User;
use Auth\Clients\Domain\User\UserFindRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{


    public function __construct(private readonly UserFindRepository $userFindRepository)
    {
    }

    public function refreshUser(UserInterface $user)
    {
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->userFindRepository->findOrFail(Uuid::fromString($identifier));
    }
}