<?php

declare(strict_types=1);

namespace Auth\Shared\Domain\Exception;

use DomainException;
use Ramsey\Uuid\UuidInterface;
use Throwable;

final class NotFoundException extends DomainException
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
}
