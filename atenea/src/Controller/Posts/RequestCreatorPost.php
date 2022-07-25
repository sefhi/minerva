<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Atenea\Posts\Application\CreatorPostCommand;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestCreatorPost
{
    #[Assert\NotBlank]
    #[Assert\Uuid(
        message: 'The value {{ value }} is not a valid {{ type }}.'
    )]
    private string $id;

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
        minMessage: 'content must be at least {{ limit }} characters long',
        maxMessage: 'content cannot be longer than {{ limit }} characters',
    )]
    private string $content;

    #[Assert\NotBlank]
    #[Assert\Uuid(
        message: 'The value {{ value }} is not a valid {{ type }}.'
    )]
    private string $authorId;

    private function __construct(string $id, string $title, string $content, string $authorId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
    }

    public static function fromPrimitive(string $id, string $title, string $content, string $authorId): self
    {
        return new self($id, $title, $content, $authorId);
    }

    public function mapToCommand(): CreatorPostCommand
    {
        return CreatorPostCommand::fromPrimitive(
            $this->id,
            $this->title,
            $this->content,
            $this->authorId
        );
    }
}
