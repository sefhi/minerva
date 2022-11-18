<?php

declare(strict_types=1);

namespace Atenea\Posts\Application\Create;

use Atenea\Authors\Application\AuthorFinder;
use Atenea\Authors\Domain\Author;
use Atenea\Posts\Domain\Post;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostId;
use Atenea\Posts\Domain\PostRepository;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\Exceptions\AuthorNotFoundException;
use Atenea\Shared\Domain\ValueObject\AuthorId;

final class CreatorPostCommandHandler
{
    public function __construct(
        private readonly PostRepository $repository,
        private readonly AuthorFinder $authorFinder
    ) {
    }

    /**
     * @throws AuthorNotFoundException
     */
    public function __invoke(CreatorPostCommand $command): void
    {
        $authorId = new AuthorId($command->getAuthorId());

        $author = $this->finderAuthor($authorId);

        $post = Post::create(
            new PostId($command->getId()),
            new PostTitle($command->getTitle()),
            new PostContent($command->getContent()),
            $author
        );

        $this->repository->save($post);
    }

    /**
     * @throws AuthorNotFoundException
     */
    private function finderAuthor(AuthorId $authorId): Author
    {
        return ($this->authorFinder)($authorId);
    }
}
