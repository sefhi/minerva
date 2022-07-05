<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use DateTimeImmutable;

final class Post
{
    private DateTimeImmutable $createdAt;

    private function __construct(
        private PostId $id,
        private PostTitle $title,
        private PostContent $content,
        private PostAuthor $author
    ) {
        $this->createdAt = new DateTimeImmutable();
    }

    public static function create(
        PostId $id,
        PostTitle $title,
        PostContent $content,
        PostAuthor $author
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

    public function getAuthor(): PostAuthor
    {
        return $this->author;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
