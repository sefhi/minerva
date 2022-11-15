<?php

namespace Auth\Domain\AccessToken;

use Auth\Domain\Bearer\TokenBearer;
use Auth\Domain\RefreshToken\RefreshToken;
use Auth\Domain\Token\Token;

interface GenerateToken
{
    public function generateAccessToken(Token $token, ?RefreshToken $refreshToken): AccessToken;

    public function generateTokenByBearer(TokenBearer $tokenBearer): Token;

    public function generateTokenFromJwtToken(string $token): Token;

    public function generateRefreshTokenFromJwtToken(string $token): RefreshToken;
}
