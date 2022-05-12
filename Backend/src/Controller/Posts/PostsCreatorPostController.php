<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Minerva\Posts\Application\CreatorPostCommand;
use Minerva\Posts\Application\CreatorPostCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostsCreatorPostController extends AbstractController
{
    public function __construct(private CreatorPostCommandHandler $commandHandler)
    {
    }

    #[Route('/post', name: 'post_creator', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $command = CreatorPostCommand::fromPrimitive($data['title'], $data['content'], $data['authorId']);

            $hasCreated = ($this->commandHandler)($command);

            if (!$hasCreated) {
                return $this->json('', Response::HTTP_CONFLICT);
            }

            return $this->json('', Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
