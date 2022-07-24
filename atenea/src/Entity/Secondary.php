<?php

declare(strict_types=1);

namespace App\Entity;

final class Secondary
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly Primary $primary
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrimary(): Primary
    {
        return $this->primary;
    }
}
