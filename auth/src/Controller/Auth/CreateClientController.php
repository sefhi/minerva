<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Entity\AuthClient;
use App\Repository\AuthClientRepository;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateClientController extends AbstractController
{
    public function __construct(private readonly AuthClientRepository $authClientRepository)
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/auth/client', methods: ['POST'])]
    public function __invoke(): JsonResponse
    {
        $client = new AuthClient();
        $client->setId(Uuid::uuid4());
        $client->setName('Pepito');
        $client->setIdentifier( hash('md5', random_bytes(16)));
        $client->setSecret( hash('sha512', random_bytes(32)));

        $this->authClientRepository->save($client, true);
        return $this->json($client, Response::HTTP_OK);
    }
}