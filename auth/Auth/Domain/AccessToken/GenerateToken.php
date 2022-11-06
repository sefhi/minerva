<?php

namespace Auth\Domain\AccessToken;

use Auth\Domain\Bearer\TokenBearer;
use Auth\Domain\RefreshToken\RefreshToken;
use Auth\Domain\Token\Token;

interface GenerateToken
{
    public function generateAccessToken(CryptKeyPrivate $privateKey, Token $token, ?RefreshToken $refreshToken): AccessToken;

    public function generateTokenByBearer(CryptKeyPublic $publicKey, TokenBearer $tokenBearer): Token;
}
