<?php

namespace Auth\Domain\AccessToken;

use Auth\Domain\Bearer\TokenBearer;
use Auth\Domain\Token\Token;

interface GenerateToken
{
    public function generate(CryptKeyPrivate $privateKey, Token $token): AccessToken;

    public function generateTokenByBearer(CryptKeyPublic $publicKey, TokenBearer $tokenBearer): Token;
}
