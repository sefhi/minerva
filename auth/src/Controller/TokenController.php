<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\AuthClient;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TokenController extends AbstractController
{

    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/auth/token')]
    public function __invoke(Request $request): JsonResponse
    {
        //1º validar request client
        $client = $this->validateClient($request);
        //2º validar user si grandType es password
        $user = $this->validateUser($request, $client);

        return $this->json('token', Response::HTTP_OK);
    }

    private function validateClient(Request $request): array
    {
        [$clientId, $secret] = $this->getClientCredentials($request);

        return [$clientId, $secret];
    }

    private function validateUser(Request $request, $client): array
    {
        $grantType = $request->get('grant_type');
        if($grantType === 'password') {

            $username = $request->get('username');

            if (!\is_string($username)) {
                throw OAuthServerException::invalidRequest('username');
            }

            $password = $request->get('username');

            if (!\is_string($password)) {
                throw OAuthServerException::invalidRequest('password');
            }

            //TODO buscamos el usuario en el repositorio
            //SI el usuario no existe o falla devolvemos una excepcion
            /**
             * $user = $this->userRepository->findByUserCredentials()
             * Internamente buscar el identificador de los credenciales
             * Luego buscamos el usuario y password
             * Y por ultimo comprobamos que identificador de credenciales y usuario sean el correcto
             */

            return [$username, $password];
        }
    }

    private function getClientCredentials(Request $request): array
    {
        $clientId = $request->get('client_id');
        $secret = $request->get('secret');

        return [$clientId, $secret];
    }

}