<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\AggregateRoot;

final class Post extends AggregateRoot
{
    private function __construct(
        private readonly PostTitle $title,
        private readonly PostContent $content,
        private readonly PostAuthor $author,
        private ?PostId $id = null,
    ) {
    }

    public static function create(
        PostTitle $title,
        PostContent $content,
        PostAuthor $author,
        ?PostId $id = null,
    ): self {
        return new self($title, $content, $author, $id);
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

    public function getAuthor(): PostAuthor
    {
        return $this->author;
    }
}
