<?php

declare(strict_types=1);

namespace Auth\Domain\AccessToken\Strategy;

use Auth\Application\Token\GenerateTokenCommand;
use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\Client\Client;

final class RefreshAccessToken implements AccessTokenMethod
{

    public function generateAccessToken(GenerateTokenCommand $command, Client $client): AccessToken
    {
        // TODO: Implement generateAccessToken() method.
    }
}