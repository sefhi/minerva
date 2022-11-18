<?php

declare(strict_types=1);

namespace Atenea\Posts\Application\Create;

final class CreatorPostCommand
{
    private function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly string $content,
        private readonly string $authorId
    ) {
    }

    public static function fromPrimitive(
        string $id,
        string $title,
        string $content,
        string $authorId
    ): self {
        return new self(
            $id,
            $title,
            $content,
            $authorId
        );
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

    public function getAuthorId(): string
    {
        return $this->authorId;
    }
}
