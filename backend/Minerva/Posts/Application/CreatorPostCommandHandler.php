<?php

declare(strict_types=1);

namespace Minerva\Posts\Application;

use Minerva\Authors\Domain\AuthorFinder;
use Minerva\Posts\Domain\Dto\PostCreatorDto;
use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostRepository;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\Exceptions\AuthorNotFoundException;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;

final class CreatorPostCommandHandler
{
    /**
     * @param PostRepository $repository
     */
    public function __construct(private PostRepository $repository, private AuthorFinder $authorFinder)
    {
    }

    /**
     * @throws AuthorNotFoundException
     */
    public function __invoke(CreatorPostCommand $command): bool
    {
        $authorId = new AuthorId($command->getAuthorId());

        ($this->authorFinder)($authorId);

        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            $authorId
        );

        return $this->repository->save($postCreatorDto);
    }
}
