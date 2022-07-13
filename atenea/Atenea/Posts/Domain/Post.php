<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\AggregateRoot;
use DateTimeImmutable;

final class Post extends AggregateRoot
{
    private DateTimeImmutable $createdAt;

    private function __construct(
        private PostTitle $title,
        private PostContent $content,
        private PostAuthor $author,
        private ?PostId $id = null,
    ) {
        $this->createdAt = new DateTimeImmutable();
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

    public function getAuthor(): ?PostAuthor
    {
        return $this->author;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
