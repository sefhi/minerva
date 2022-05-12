<?php

declare(strict_types=1);

namespace Minerva\Posts\Application;

use DateTimeImmutable;
use JsonSerializable;

final class PostResponse implements JsonSerializable
{
    private function __construct(
        private int $id,
        private string $title,
        private string $content,
        private DateTimeImmutable $createdAt,
        private PostAuthorResponse $author
    ) {
    }

    public static function create(
        int $id,
        string $title,
        string $content,
        DateTimeImmutable $createdAt,
        PostAuthorResponse $author
    ): self {
        return new self($id, $title, $content, $createdAt, $author);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthor(): PostAuthorResponse
    {
        return $this->author;
    }


    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
