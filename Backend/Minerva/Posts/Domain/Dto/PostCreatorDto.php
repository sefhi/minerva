<?php

declare(strict_types=1);

namespace Minerva\Posts\Domain\Dto;

use Minerva\Posts\Domain\PostContent;
use Minerva\Posts\Domain\PostTitle;
use Minerva\Shared\Domain\ValueObject\Author\AuthorId;

final class PostCreatorDto
{
    private function __construct(
        private PostTitle $title,
        private PostContent $content,
        private AuthorId $id
    ) {
    }

    public static function create(
        PostTitle $title,
        PostContent $content,
        AuthorId $id
    ): self {
        return new self(
            $title,
            $content,
            $id
        );
    }

    public function getTitle(): PostTitle
    {
        return $this->title;
    }

    public function getContent(): PostContent
    {
        return $this->content;
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }
}
