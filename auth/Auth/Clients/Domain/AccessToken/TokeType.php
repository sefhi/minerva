<?php

declare(strict_types=1);

namespace Auth\Clients\Domain\AccessToken;

enum TokeType : string
{
    case BEARER = 'bearer';
}
