<?php

declare(strict_types=1);

namespace Auth\Domain\Client\Exception;

use Auth\Domain\Client\Client;
use Auth\Domain\Client\ClientIdentifier;
use Auth\Domain\Client\Grant;
use Auth\Shared\Domain\Exception\OperationForbiddenException;

final class ClientOperationDeniedException extends OperationForbiddenException
{
    public static function inactive(ClientIdentifier $identifier) : self {
        return new self(
            sprintf(
                '%s with identifier %s not is active',
                Client::class,
                $identifier
            )
        );
    }

    public static function grantNotSupported(ClientIdentifier $identifier, Grant $grant) : self {
        return new self(
            sprintf(
                '%s with identifier %s not support this grant %s',
                Client::class,
                $identifier,
                $grant->value
            )
        );
    }
}
