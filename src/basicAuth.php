<?php

namespace src;

use Tuupola\Middleware\HttpBasicAuthentication;

function basicAuth(): HttpBasicAuthentication
{
    /**
     * Login bruto que pode ser utilizado diretamente no banco
     * Não está sendo utilizado no momento, mas pode ser útil
     * em situações críticas
     */
    return new HttpBasicAuthentication([
        "relaxed" => ["api.eclasse.io"],
        "users" => [
            "username" => "password"
        ]
    ]);
}