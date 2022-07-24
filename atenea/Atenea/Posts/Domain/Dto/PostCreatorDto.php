<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain\Dto;

use Atenea\Authors\Domain\Author;
use Atenea\Posts\Domain\PostContent;
use Atenea\Posts\Domain\PostId;
use Atenea\Posts\Domain\PostTitle;

final class PostCreatorDto
{
    private function __construct(
        private readonly PostId $id,
        private readonly PostTitle $title,
        private readonly PostContent $content,
        private readonly Author $author
    ) {
    }

    public static function create(
        PostId $id,
        PostTitle $title,
        PostContent $content,
        Author $author
    ): self {
        return new self(
            $id,
            $title,
            $content,
            $author
        );
    }

    public function getId(): PostId
    {
        return $this->id;
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
