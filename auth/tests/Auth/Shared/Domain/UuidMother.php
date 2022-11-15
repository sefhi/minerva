<?php

declare(strict_types=1);

namespace Tests\Auth\Shared\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UuidMother
{
    public static function create(string $value): UuidInterface
    {
        return Uuid::fromString($value);
    }

    public static function random(): UuidInterface
    {
        return self::create(MotherFactory::random()->uuid());
    }
}
