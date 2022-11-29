<?php

declare(strict_types=1);

namespace App\Controller\Posts\Dto;

use ReturnTypeWillChange;

final class PostResponse implements \JsonSerializable
{
    private function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly string $content,
        private readonly PostAuthorResponse $author
    ) {
    }

    public static function create(
        string $id,
        string $title,
        string $content,
        PostAuthorResponse $author
    ): self {
        return new self($id, $title, $content, $author);
    }

    public function getId(): string
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

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
