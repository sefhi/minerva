<?php

declare(strict_types=1);

namespace Auth\Clients\Infrastructure\Symfony\Security\User;

use Auth\Clients\Domain\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

final class SecurityUser implements UserInterface
{

    private string $id;
    private string $username;
    private string $password;
    private array $roles;

    private function __construct(User $user)
    {
        $this->id = $user->getUserIdentifier();
        $this->username = $user->getEmail();
        $this->password = $user->getPassword()->value();
        $this->roles = $user->getRoles();
    }

    public static function fromDomain(User $user): self
    {
        return new self($user);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }
}