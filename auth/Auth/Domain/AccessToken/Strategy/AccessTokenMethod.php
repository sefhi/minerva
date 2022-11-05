<?php

namespace Auth\Domain\AccessToken\Strategy;

use Auth\Application\Token\GenerateTokenCommand;
use Auth\Domain\AccessToken\AccessToken;
use Auth\Domain\Client\Client;

interface AccessTokenMethod
{
    public function generateAccessToken(GenerateTokenCommand $command, Client $client) : AccessToken;
}
