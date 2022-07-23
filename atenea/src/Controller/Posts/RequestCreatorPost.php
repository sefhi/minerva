<?php

declare(strict_types=1);

namespace App\Controller\Posts;

use Atenea\Posts\Application\CreatorPostCommand;
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
    /** @phpstan-ignore-next-line */
    private $title;
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 5,
        max: 10000,
        minMessage: 'content must be at least {{ limit }} characters long',
        maxMessage: 'content cannot be longer than {{ limit }} characters',
    )]
    /** @phpstan-ignore-next-line */
    private $content;
    #[Assert\NotBlank]
    #[Assert\Uuid(
        message: 'The value {{ value }} is not a valid {{ type }}.'
    )]
    /** @phpstan-ignore-next-line */
    private $authorId;

    /** @phpstan-ignore-next-line */
    private function __construct($title, $content, $authorId)
    {
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
    }

    /** @phpstan-ignore-next-line */
    public static function fromPrimitive($title, $content, $authorId): self
    {
        return new self($title, $content, $authorId);
    }

    public function mapToCommand(): CreatorPostCommand
    {
        return CreatorPostCommand::fromPrimitive(
            $this->title,
            $this->content,
            $this->authorId
        );
    }
}
