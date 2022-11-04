<?php

declare(strict_types=1);

namespace Auth\Application\User;

use Auth\Domain\User\PasswordHasher;
use Auth\Domain\User\User;
use Auth\Domain\User\UserFindRepository;
use Auth\Domain\User\UserSaveRepository;
use Ramsey\Uuid\Uuid;

final class CreateUserCommandHandler
{

    public function __construct(
        private readonly UserFindRepository $userFindRepository,
        private readonly UserSaveRepository $userSaveRepository,
        private readonly PasswordHasher $passwordHasher
    )
    {
    }

    public function __invoke(CreateUserCommand $command): User
    {

        $this->userFindRepository->findOneByEmailOrFail($command->getEmail());

        $user = User::create(
            Uuid::uuid4(),
            $command->getEmail(),
            $this->passwordHasher->hash($command->getPlainPassword()),
            []
        );

        $this->userSaveRepository->save($user);

        return $user;
    }
}
