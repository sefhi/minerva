<?php

namespace Auth\Clients\Domain\AccessToken;

use Auth\Clients\Domain\Token;

interface GenerateToken
{
    public function generate(CryptKey $privateKey, Token $token): AccessToken;
}