<?php

declare(strict_types=1);

namespace Minerva\Posts\Domain;

use Minerva\Shared\Domain\ValueObject\Author\AuthorId;
use Minerva\Shared\Domain\ValueObject\Email;
use Minerva\Shared\Domain\ValueObject\Name;
use Minerva\Shared\Domain\ValueObject\Phone;
use Minerva\Shared\Domain\ValueObject\Username;
use Minerva\Shared\Domain\ValueObject\Website;

final class PostAuthor
{
    private function __construct(
        private AuthorId $id,
        private Name $name,
        private Phone $phone,
        private Username $username,
        private Website $web,
        private Email $email
    ) {
    }

    public static function create(
        AuthorId $id,
        Name $name,
        Phone $phone,
        Username $username,
        Website $web,
        Email $email
    ): self {
        return new self(
            $id,
            $name,
            $phone,
            $username,
            $web,
            $email
        );
    }

    /**
     * @return AuthorId
     */
    public function getId(): AuthorId
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @return Username
     */
    public function getUsername(): Username
    {
        return $this->username;
    }

    /**
     * @return Website
     */
    public function getWeb(): Website
    {
        return $this->web;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

}
