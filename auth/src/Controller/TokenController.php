<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\AuthToken;
use Auth\Clients\Domain\AccessToken\CryptKey;
use Auth\Clients\Domain\AccessToken\CryptKeyPrivate;
use Auth\Clients\Domain\AccessToken\GenerateToken;
use Auth\Clients\Domain\ClientFindRepository;
use Auth\Clients\Domain\ClientIdentifier;
use Auth\Clients\Domain\ClientSecret;
use Auth\Clients\Domain\Grant;
use Auth\Clients\Domain\Token;
use Auth\Clients\Domain\TokenSaveRepository;
use Exception;
use League\OAuth2\Server\Exception\OAuthServerException;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TokenController extends AbstractController
{

    public function __construct(
        private ClientFindRepository $findClientRepository,
        private TokenSaveRepository $tokenSaveRepository,
        private GenerateToken $generateToken,
    )
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
//        $user = $this->validateUser($request, $client);
        //3º access token
//        $this->accessToken();

        return $this->json('token', Response::HTTP_OK);
    }

    private function validateClient(Request $request): array
    {
        [$clientId, $secret] = $this->getClientCredentials($request);
        $grantType = $request->get('grant_type');

        $identifier = new ClientIdentifier($clientId);
        $client = $this->findClientRepository->findByIdentifier($identifier);
        if($this->findClientRepository->validateClient(
            $identifier,
            new ClientSecret($secret),
            Grant::from($grantType))
        ) {
            $date = new \DateTimeImmutable();
            $expiredAt = $date->add(new \DateInterval('PT2H'));
            $token = Token::create(
                Uuid::uuid4(),
                $client,
                $expiredAt,
                false,
            );

            $this->tokenSaveRepository->save($token);

            $accessToken = $this->generateToken->generate(
                CryptKeyPrivate::create(getenv('OAUTH_PRIVATE_KEY')),
                $token
            );
        }

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

        throw OAuthServerException::unsupportedGrantType();
    }

    private function getClientCredentials(Request $request): array
    {
        $clientId = $request->get('client_id');
        $secret = $request->get('secret');

        return [$clientId, $secret];
    }

    private function accessToken(Request $request)
    {

        //Busco el client
        $this->authClientRepository->findBy(['identifier' => $request->get('client_id')]);
        $uniqueIdentifier = \bin2hex(\random_bytes(40));
        $authToken = new AuthToken();
        $authToken->setClient();
    }

}
