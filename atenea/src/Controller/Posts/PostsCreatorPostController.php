<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Exception;
use InvalidArgumentException;
use JsonException;
use Atenea\Posts\Application\CreatorPostCommandHandler;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Stringable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class PostsCreatorPostController extends AbstractController
{
    public function __construct(
        private readonly CreatorPostCommandHandler $commandHandler,
        private readonly ValidatorInterface $validator,
    ) {
    }

    #[Route('/posts', name: 'post_creator', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $json = $request->getContent();

            if (!$json) {
                throw new InvalidArgumentException('invalid json', Response::HTTP_NOT_ACCEPTABLE);
            }

            $data = json_decode(
                $json,
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            $requestCreatorPost = RequestCreatorPost::fromPrimitive(
                $data['title'],
                $data['content'],
                $data['authorId']
            );

            $errors = $this->validator->validate($requestCreatorPost);

            if (count($errors)) {
                return $this->handleErrors($errors);
            }

            $hasCreated = ($this->commandHandler)($requestCreatorPost->mapToCommand());

            if ($hasCreated) {
                return $this->json('', Response::HTTP_CREATED);
            }

            $response = ['error' => 'resource has not been created'];
            $statusCode = Response::HTTP_CONFLICT;
        } catch (InvalidArgumentException|AuthorNotFoundException $exception) {
            $response = ['error' => $exception->getMessage()];
            $statusCode = $exception->getCode();
        } catch (Exception|JsonException $exception) {
            $response = ['error' => $exception->getMessage()];
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->json($response, $statusCode);
    }

    private function handleErrors(ConstraintViolationListInterface $errors): JsonResponse
    {
        $formattedErrors = $this->getFormattedErrors($errors);

        return $this->json(
            [
                'errors' => $formattedErrors,
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * @return array<int, array{message: string|Stringable, field: string}>
     */
    private function getFormattedErrors(ConstraintViolationListInterface $errors): array
    {
        $formattedErrors = [];
        foreach ($errors as $key => $error) {
            $formattedErrors[$key]['message'] = $error->getMessage();
            $formattedErrors[$key]['field'] = $error->getPropertyPath();
        }

        return $formattedErrors;
    }
}
