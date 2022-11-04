<?php

namespace Tests\Auth\Application\User;

use Auth\Application\User\CreateUserCommand;
use Auth\Application\User\CreateUserCommandHandler;
use Auth\Domain\User\PasswordHasher;
use Tests\Auth\Domain\User\PasswordMother;
use Auth\Domain\User\UserFindRepository;
use Auth\Domain\User\UserSaveRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tests\Auth\Domain\User\UserMother;

class CreateUserCommandHandlerTest extends TestCase
{
    private MockObject|UserFindRepository $userFindRepositoryMock;
    private MockObject|UserSaveRepository $userSaveRepositoryMock;
    private MockObject|PasswordHasher $passwordHasherMock;

    protected function setUp(): void
    {
        $this->userFindRepositoryMock = $this->createMock(UserFindRepository::class);
        $this->userSaveRepositoryMock = $this->createMock(UserSaveRepository::class);
        $this->passwordHasherMock = $this->createMock(PasswordHasher::class);
    }


    /** @test */
    public function itShouldSaveAnUser(): void
    {
        // GIVEN
        $user = UserMother::random();
        $command = CreateUserCommand::create(
            $user->getEmail(),
            PasswordMother::plainPassword(),
            $user->getRoles()
        );

        // WHEN
        $this->userFindRepositoryMock
            ->expects(self::once())
            ->method('findOneByEmailOrFail')
            ->with($user->getEmail())
            ->willReturn($user);

        $this->passwordHasherMock
            ->expects(self::once())
            ->method('hash')
            ->with($command->getPlainPassword())
            ->willReturn($user->getPassword());

        $this->userSaveRepositoryMock
            ->expects(self::once())
            ->method('save');

        $commandHandler = new CreateUserCommandHandler(
            $this->userFindRepositoryMock,
            $this->userSaveRepositoryMock,
            $this->passwordHasherMock
        );

        // THEN
        ($commandHandler)($command);
    }
}
