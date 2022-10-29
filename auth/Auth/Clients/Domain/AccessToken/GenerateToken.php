<?php

namespace Auth\Clients\Domain\AccessToken;

use Auth\Clients\Domain\Bearer\TokenBearer;
use Auth\Clients\Domain\Token;

interface GenerateToken
{
    public function generate(CryptKeyPrivate $privateKey, Token $token): AccessToken;

    public function generateTokenByBearer(CryptKeyPublic $publicKey, TokenBearer $tokenBearer): Token;
}
