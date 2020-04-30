<?php

namespace src;

use Tuupola\Middleware\JwtAuthentication;

function jwtAuth(): JwtAuthentication
{
    return new JwtAuthentication([
        "relaxed" => ["api.eclasse.io", "187.23.94.198", "127.0.0.1", "192.168.0.12"],
        "secret" => getenv("JWT_SECRET_KEY"),
        "attribute" => "jwt"
    ]);
}