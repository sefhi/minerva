<?php

declare(strict_types=1);

namespace Minerva\Posts\Domain;

final class Post
{
    private function __construct(
        private PostId $id,
        private PostTitle $title,
        private PostContent $content,
        private PostAuthor $author
    ) {
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
}
