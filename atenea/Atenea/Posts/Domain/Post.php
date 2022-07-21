<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\Aggregate\AggregateRoot;
use Atenea\Shared\Domain\ValueObject\AuthorId;

final class Post extends AggregateRoot
{
    private function __construct(
        private readonly PostTitle $title,
        private readonly PostContent $content,
        private readonly AuthorId $authorId,
        private ?PostId $id = null,
    ) {
    }

    public static function create(
        PostTitle $title,
        PostContent $content,
        AuthorId $authorId,
        ?PostId $id = null,
    ): self {
        return new self($title, $content, $authorId, $id);
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

    public function getAuthorId(): AuthorId
    {
        return $this->authorId;
    }
}
