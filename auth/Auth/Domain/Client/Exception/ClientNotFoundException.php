<?php

declare(strict_types=1);

namespace Auth\Domain\Client\Exception;

use Auth\Domain\Client\Client;
use Auth\Domain\Client\ClientIdentifier;
use Auth\Shared\Domain\Exception\NotFoundException;

final class ClientNotFoundException extends NotFoundException
{
    public static function withClientIdentifier(ClientIdentifier $identifier): self
    {
        return new self(
            sprintf(
                'An instance of %s with identifier %s was not found.',
                Client::class,
                $identifier
            )
        );
    }
}
