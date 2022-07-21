<?php

declare(strict_types=1);

namespace Atenea\Authors\Domain;

use Atenea\Shared\Domain\ValueObject\AuthorId;
use Atenea\Shared\Domain\ValueObject\Email;
use Atenea\Shared\Domain\ValueObject\Name;
use Atenea\Shared\Domain\ValueObject\Username;
use Atenea\Shared\Domain\ValueObject\Website;

final class Author
{
    private function __construct(
        private AuthorId $id,
        private readonly Name $name,
        private readonly Username $username,
        private readonly Website $website,
        private readonly Email $email
    ) {
    }

    public static function create(
        AuthorId $id,
        Name $name,
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

    public function getWebsite(): Website
    {
        return $this->website;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
