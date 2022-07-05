<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain\Dto;

use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostTitle;
use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

final class PostCreatorDto
{
    private function __construct(
        private PostTitle $title,
        private PostContent $content,
        private AuthorId $authorId
    ) {
    }

    public static function create(
        PostTitle $title,
        PostContent $content,
        AuthorId $id
    ): self {
        return new self(
            $title,
            $content,
            $id
        );
    }

    public function getTitle(): PostTitle
    {
        return $this->title;
    }

    public function getContent(): PostContent
    {
        return $this->content;
    }

    public function getAuthorId(): AuthorId
    {
        return $this->authorId;
    }
}
