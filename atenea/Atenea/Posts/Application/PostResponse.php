<?php

declare(strict_types=1);

namespace Atenea\Posts\Application;

use JsonSerializable;
use ReturnTypeWillChange;

final class PostResponse implements JsonSerializable
{
    private function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $content,
        private readonly string $authorId
    ) {
    }

    public static function create(
        int $id,
        string $title,
        string $content,
        string $authorId
    ): self {
        return new self($id, $title, $content, $authorId);
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

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    #[ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
