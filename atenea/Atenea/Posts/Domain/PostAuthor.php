<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

class PostAuthor
{
    private function __construct(
        private ?AuthorId $id = null,
        private PostAuthorName $name,
        private PostAuthorUsername $username,
        private PostAuthorWebsite $website,
        private PostAuthorEmail $email
    ) {
    }

    public static function create(
        ?AuthorId $id = null,
        PostAuthorName $name,
        PostAuthorUsername $username,
        PostAuthorWebsite $website,
        PostAuthorEmail $email
    ): self {
        return new self(
            $id,
            $name,
            $username,
            $website,
            $email
        );
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }

    public function getName(): PostAuthorName
    {
        return $this->name;
    }

    public function getUsername(): PostAuthorUsername
    {
        return $this->username;
    }

    public function getWebsite(): PostAuthorWebsite
    {
        return $this->website;
    }

    public function getEmail(): PostAuthorEmail
    {
        return $this->email;
    }
}
