<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain\Dto;

use Atenea\Authors\Domain\Author;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostTitle;

final class PostCreatorDto
{
    private function __construct(
        private readonly PostTitle $title,
        private readonly PostContent $content,
        private readonly Author $author
    ) {
    }

    public static function create(
        PostTitle $title,
        PostContent $content,
        Author $author
    ): self {
        return new self(
            $title,
            $content,
            $author
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

    public function getAuthor(): Author
    {
        return $this->author;
    }
}
