<?php

declare(strict_types=1);

namespace Atenea\Posts\Domain;

use Atenea\Shared\Domain\ValueObject\Author\AuthorId;
use Atenea\Shared\Domain\ValueObject\Email;
use Atenea\Shared\Domain\ValueObject\Name;
use Atenea\Shared\Domain\ValueObject\Username;
use Atenea\Shared\Domain\ValueObject\Website;

class PostAuthor
{
    private function __construct(
        private readonly Name $name,
        private readonly Username $username,
        private readonly Website $website,
        private readonly Email $email,
        private AuthorId $id,
    ) {
    }

    public static function create(
        Name $name,
        Username $username,
        Website $website,
        Email $email,
        AuthorId $id,
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

    public function getName(): Name
    {
        return $this->name;
    }

    public function getUsername(): Username
    {
        return $this->username;
    }

    public function getWebsite(): Website
    {
        return $this->website;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
