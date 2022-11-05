<?php

declare(strict_types=1);

namespace App\Controller;

use Auth\Domain\User\Password;
use Auth\Domain\User\User;
use Auth\Domain\User\UserInterface;
use Auth\Domain\User\UserSaveRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

final class TestController extends AbstractController
{

    #[Route('/api/test')]
    public function __invoke() : JsonResponse
    {
        return $this->json('Hola');
    }
}