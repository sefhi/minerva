<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Controller\Auth\Dto\CredentialsDto;
use Auth\Application\Client\CreateClientCommand;
use Auth\Application\Client\CreateClientCommandHandler;
use Auth\Domain\Client\ClientName;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateClientPostController extends AbstractController
{
    public function __construct(
        private readonly CreateClientCommandHandler $commandHandler,
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/auth/client', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $request = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $command = CreateClientCommand::create(
            new ClientName($request['name']),
            $request['grant']
        );
        $client = ($this->commandHandler)($command);

        return $this->json(CredentialsDto::fromClientCredentials($client->getCredentials()), Response::HTTP_OK);
    }
}