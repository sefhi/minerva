<?php

declare(strict_types=1);

namespace Tests\Auth\Domain\User;

use Auth\Domain\User\Email;
use Tests\Auth\Shared\Domain\MotherFactory;

final class EmailMother
{
    public static function create(string $value): Email
    {
        return Email::fromString($value);
    }
    
    public static function random(): Email
    {
        return self::create(MotherFactory::random()->email());
    }
}