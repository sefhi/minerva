<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Shared\Domain\ValueObject\Email;
use Atenea\Shared\Domain\ValueObject\Name;
use Atenea\Shared\Domain\ValueObject\Username;
use Atenea\Shared\Domain\ValueObject\Website;

final class PostAuthor
{
    private function __construct(
        private AuthorId $id,
        private PostName $name,
        private Username $username,
        private Website $web,
        private Email $email
    ) {
    }

    public static function create(
        AuthorId $id,
        PostName $name,
        Username $username,
        Website $web,
        Email $email
    ): self {
        return new self(
            $id,
            $name,
            $username,
            $web,
            $email
        );
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getUsername(): Username
    {
        return $this->username;
    }

    public function getWeb(): Website
    {
        return $this->web;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
