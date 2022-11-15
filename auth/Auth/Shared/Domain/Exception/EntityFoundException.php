<?php

declare(strict_types=1);

namespace Auth\Shared\Domain\Exception;

use Auth\Domain\User\Email;

final class EntityFoundException extends \DomainException
{
    public static function entityWithEmail(string $entityClass, Email $email): self
    {
        return new self(
            sprintf(
                'An instance of %s with id %s was found.',
                $entityClass,
                $email
            )
        );
    }
}
