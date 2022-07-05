<?php

declare(strict_types=1);

namespace Atenea\Posts\Application;

use Atenea\Authors\Domain\AuthorFinder;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

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

        $this->assertExistAuthor($authorId);

        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            $authorId
        );

        return $this->repository->save($postCreatorDto);
    }

    /**
     * @throws AuthorNotFoundException
     */
    private function assertExistAuthor(AuthorId $authorId): void
    {
        ($this->authorFinder)($authorId);
    }
}