<?php

declare(strict_types=1);

namespace Atenea\Posts\Application;

use Atenea\Authors\Domain\AuthorFinder;
use Atenea\Posts\Domain\Dto\PostCreatorDto;
use Atenea\Posts\Domain\PostAuthor;
use Atenea\Posts\Domain\PostAuthorEmail;
use Atenea\Posts\Domain\PostAuthorName;
use Atenea\Posts\Domain\PostAuthorUsername;
use Atenea\Posts\Domain\PostAuthorWebsite;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

final class CreatorPostCommandHandler
{
    /**
     * @param PostRepository $repository
     * @param AuthorFinder   $authorFinder
     */
    public function __construct(private readonly PostRepository $repository, private readonly AuthorFinder $authorFinder)
    {
    }

    /**
     * @throws AuthorNotFoundException
     */
    public function __invoke(CreatorPostCommand $command): bool
    {
        $authorId = new AuthorId($command->getAuthorId());

        $postAuthor = $this->finderAuthor($authorId);

        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            $postAuthor
        );

        return $this->repository->save($postCreatorDto);
    }

    /**
     * @throws AuthorNotFoundException
     */
    private function finderAuthor(AuthorId $authorId): PostAuthor
    {
        $author = ($this->authorFinder)($authorId);

        return PostAuthor::create(
            new PostAuthorName($author->getName()->value()),
            new PostAuthorUsername($author->getUsername()->value()),
            new PostAuthorWebsite($author->getWeb()->value()),
            new PostAuthorEmail($author->getEmail()->value()),
            $author->getId()
        );
    }

}
