<?php

declare(strict_types=1);

namespace Atenea\Posts\Application;

use Atenea\Authors\Application\AuthorFinder;
use Atenea\Authors\Domain\Author;
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

        $author = $this->finderAuthor($authorId);

        $postCreatorDto = PostCreatorDto::create(
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            $author
        );

        return $this->repository->save($postCreatorDto);
    }

    /**
     * @throws AuthorNotFoundException
     */
    private function finderAuthor(AuthorId $authorId): Author
    {
        $author = ($this->authorFinder)($authorId);

        return Author::create(
            $author->getId(),
            $author->getName(),
            $author->getUsername(),
            $author->getWebsite(),
            $author->getEmail(),
        );
    }
}
