<?php

declare(strict_types=1);

namespace App\Controller;

use Auth\Clients\Domain\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

final class TestController extends AbstractController
{


    public function __construct(PasswordHasherFactoryInterface $passwordHasher)
    {
    }

    #[Route('/api/test')]
    public function __invoke()
    {
//        User::create();
        return $this->json('Hola');
    }
}