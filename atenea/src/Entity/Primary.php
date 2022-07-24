<?php

declare(strict_types=1);

namespace App\Entity;

final class Primary
{
    public function __construct(
        private string $id,
        private string $name
    ) {
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
