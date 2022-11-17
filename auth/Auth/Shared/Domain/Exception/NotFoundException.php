<?php

declare(strict_types=1);

namespace Auth\Shared\Domain\Exception;

use Auth\Domain\User\Email;
use Ramsey\Uuid\UuidInterface;

class NotFoundException extends \DomainException
{
    public static function entityWithId(string $entityClass, UuidInterface $id): self
    {
        return new self(
            sprintf(
                'An instance of %s with id %s was not found.',
                $entityClass,
                $id
            )
        );
    }

    public static function entityWithEmail(string $entityClass, Email $email): self
    {
        return new self(
            sprintf(
                'An instance of %s with email %s was not found.',
                $entityClass,
                $email
            )
        );
    }
}
