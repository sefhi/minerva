<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Controller\Auth\Dto\UserDto;
use Auth\Application\User\CreateUserCommand;
use Auth\Application\User\CreateUserCommandHandler;
use Auth\Domain\User\Email;
use Auth\Domain\User\Password;
use Auth\Domain\User\Role;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateUserPostController extends AbstractController
{

    public function __construct(private readonly CreateUserCommandHandler $commandHandler)
    {
    }

    /**
     * @throws JsonException
     */
    #[Route('/auth/user', name: 'auth_user', methods: ['POST'])]
    public function __invoke(Request $request) : JsonResponse
    {
        $request = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $user = ($this->commandHandler)(CreateUserCommand::create(
            Email::fromString($request['email']),
            Password::fromString($request['password']),
            [],
        ));

        return $this->json(UserDto::createFromUser($user), Response::HTTP_CREATED);
    }
}