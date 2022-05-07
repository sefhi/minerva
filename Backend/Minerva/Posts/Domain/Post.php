<?php

declare(strict_types=1);

namespace Minerva\Posts\Domain;

final class Post
{
    private function __construct(
        private int $id,
        private string $title,
        private string $content,
        private int $userId
    ) {
    }

    public static function create(int $id, string $title, string $content, int $userId): self
    {
        return new self($id, $title, $content, $userId);
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

    public function getUserId(): int
    {
        return $this->userId;
    }
}