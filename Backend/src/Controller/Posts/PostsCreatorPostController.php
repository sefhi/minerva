<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Exception;
use Minerva\Posts\Application\CreatorPostCommand;
use Minerva\Posts\Application\CreatorPostCommandHandler;
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
        private CreatorPostCommandHandler $commandHandler,
        private ValidatorInterface $validator,
    ) {
    }

    #[
        Route('/post', name: 'post_creator', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = json_decode(
                $request->getContent(),
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

            $command = CreatorPostCommand::fromPrimitive($data['title'], $data['content'], $data['authorId']);

            $hasCreated = ($this->commandHandler)($command);

            if (!$hasCreated) {
                return $this->json('', Response::HTTP_CONFLICT);
            }

            return $this->json('', Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
