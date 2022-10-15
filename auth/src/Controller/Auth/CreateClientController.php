<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Entity\AuthClient;
use App\Repository\AuthClientRepository;
use Auth\Clients\Domain\Client;
use Auth\Clients\Domain\ClientCredentialsParam;
use Auth\Clients\Domain\ClientFindRepository;
use Auth\Clients\Domain\ClientGrants;
use Auth\Clients\Domain\ClientIdentifier;
use Auth\Clients\Domain\ClientName;
use Auth\Clients\Domain\ClientRedirectUris;
use Auth\Clients\Domain\ClientSaveRepository;
use Auth\Clients\Domain\ClientScopes;
use Auth\Clients\Domain\ClientSecret;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateClientController extends AbstractController
{
    public function __construct(
        private readonly ClientSaveRepository $saveRepository,
        private readonly ClientFindRepository $findRepository,
    )
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/auth/client', methods: ['POST'])]
    public function __invoke(): JsonResponse
    {
        $client = new Client(
            Uuid::uuid4(),
            new ClientCredentialsParam(
                new ClientIdentifier(hash('md5', random_bytes(16))),
                new ClientName('Pepito10'),
                new ClientSecret(hash('sha512', random_bytes(32))),
            ),
            new ClientRedirectUris(['sdasd']),
            new ClientGrants(['adad']),
            new ClientScopes(['adad']),
        );


        $this->saveRepository->save($client);

        $client = $this->findRepository->findByIdentifier($client->getCredentials()->getIdentifier());

        return $this->json($client, Response::HTTP_OK);
    }
}