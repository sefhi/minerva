<?php

declare(strict_types=1);

namespace Minerva\Posts\Application;

use Minerva\Posts\Domain\Dto\PostCreatorDto;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostRepository;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;

final class CreatorPostCommandHandler
{
    /**
     * @param PostRepository $repository
     */
    public function __construct(private PostRepository $repository)
    {
    }

    public function __invoke(CreatorPostCommand $command): bool
    {
        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            new AuthorId($command->getAuthorId())
        );

        return $this->repository->save($postCreatorDto);
    }
}
