<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\ValueObject\Author\AuthorId;

class PostAuthor
{
    private function __construct(
        private PostAuthorName $name,
        private PostAuthorUsername $username,
        private PostAuthorWebsite $website,
        private PostAuthorEmail $email,
        private ?AuthorId $id = null,
    ) {
    }

    public static function create(
        PostAuthorName $name,
        PostAuthorUsername $username,
        PostAuthorWebsite $website,
        PostAuthorEmail $email,
        ?AuthorId $id = null,
    ): self {
        return new self(
            $name,
            $username,
            $website,
            $email,
            $id
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
