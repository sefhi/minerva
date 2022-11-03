<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Symfony\Security;

use Auth\Domain\User\User;
use Auth\Domain\User\UserFindRepository;
use Auth\Infrastructure\Symfony\Security\User\SecurityUser;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class SecurityUserProvider implements UserProviderInterface
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
        $user = $this->userFindRepository->findOrFail(Uuid::fromString($identifier));

        return SecurityUser::fromDomain($user);
    }
}
