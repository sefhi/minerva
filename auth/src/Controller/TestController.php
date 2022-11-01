<?php

declare(strict_types=1);

namespace App\Controller;

use Auth\Clients\Domain\User\Password;
use Auth\Clients\Domain\User\User;
use Auth\Clients\Domain\User\UserInterface;
use Auth\Clients\Domain\User\UserSaveRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

final class TestController extends AbstractController
{


    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasher,
        private UserSaveRepository $saveRepository,
    )
    {
    }

    #[Route('/api/test')]
    public function __invoke()
    {
        $password = Password::fromString('qwerty69');
        $password = $this->passwordHasher->getPasswordHasher(UserInterface::class)->hash($password->value());

        $user = User::create(
            Uuid::uuid4(),
            'pepe@pepe.es',
            Password::fromString($password),
            []
        );

        $this->saveRepository->save($user);

        $isValid = $this->passwordHasher
            ->getPasswordHasher(UserInterface::class)
            ->verify($user->getPassword()->value(), 'qwerty69');


        return $this->json('Hola');
    }
}