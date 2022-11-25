<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use App\Tests\Controller\BaseController;
use Atenea\Posts\Application\Create\CreatorPostCommandHandler;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Infrastructure\Exceptions\ExceptionsHttpStatusCodeMapping;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class PostsCreatorPostController extends BaseController
{
    public function __construct(
        private readonly CreatorPostCommandHandler $commandHandler,
        private readonly ValidatorInterface $validator,
        private readonly ExceptionsHttpStatusCodeMapping $exceptionMapping,
    ) {
        parent::__construct($this->exceptionMapping);
    }

    /**
     * @throws AuthorNotFoundException
     * @throws \JsonException
     */
    #[Route('/posts', name: 'post_creator', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $json = $request->getContent();

        if (!$json) {
            throw new \InvalidArgumentException('invalid json', Response::HTTP_NOT_ACCEPTABLE);
        }

        $data = json_decode(
            $json,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $requestCreatorPost = RequestCreatorPost::fromPrimitive(
            $data['id'],
            $data['title'],
            $data['content'],
            $data['authorId']
        );

        $errors = $this->validator->validate($requestCreatorPost);

        if (count($errors)) {
            return $this->handleErrors($errors);
        }

        ($this->commandHandler)($requestCreatorPost->mapToCommand());

        return $this->json('', Response::HTTP_CREATED);
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
     * @return array<int, array{message: string|\Stringable, field: string}>
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

    public function exceptions(): array
    {
        return [
            AuthorNotFoundException::class => Response::HTTP_NOT_FOUND,
        ];
    }
}
