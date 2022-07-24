<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Authors\Domain\Author;
use Atenea\Shared\Domain\Aggregate\AggregateRoot;

final class Post extends AggregateRoot
{
    private function __construct(
        private readonly PostId $id,
        private readonly PostTitle $title,
        private readonly PostContent $content,
        private readonly Author $author,
    ) {
    }

    public static function create(
        PostId $id,
        PostTitle $title,
        PostContent $content,
        Author $author,
    ): self {
        return new self($id, $title, $content, $author);
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
