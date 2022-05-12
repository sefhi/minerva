<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Symfony\Component\Validator\Constraints as Assert;

final class RequestCreatorPost
{
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 5,
        max: 100,
        minMessage: 'title must be at least {{ limit }} characters long',
        maxMessage: 'title cannot be longer than {{ limit }} characters',
    )]
    private string $title;
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 5,
        max: 10000,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private string $content;
    #[Assert\NotBlank]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.'
    )]
    private int $authorId;

    /**
     * @param string $title
     * @param string $content
     * @param int    $authorId
     */
    private function __construct(string $title, string $content, int $authorId)
    {
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
    }

    public static function fromPrimitive(string $title, string $content, int $authorId): self
    {
        return new self($title, $content, $authorId);
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }
}
