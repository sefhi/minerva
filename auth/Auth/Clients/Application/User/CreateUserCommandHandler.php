<?php

declare(strict_types=1);

namespace Auth\Clients\Application\User;

use Auth\Clients\Domain\User\Password;
use Auth\Clients\Domain\User\PasswordHasher;
use Auth\Clients\Domain\User\User;
use Auth\Clients\Domain\User\UserFindRepository;
use Auth\Clients\Domain\User\UserSaveRepository;
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

    public function __invoke(CreateUserCommand $command): void
    {

        $this->userFindRepository->findOneByEmailOrFail($command->getEmail());

        $user = User::create(
            Uuid::uuid4(),
            $command->getEmail(),
            $this->passwordHasher->hash($command->getPlainPassword()),
            []
        );

        $this->userSaveRepository->save($user);
    }
}
