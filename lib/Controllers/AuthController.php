<?php

namespace App\Controllers;

use App\DAO\MySQL\EclasseBD\TokenDAO;
use App\DAO\MySQL\EclasseBD\UsuarioDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\TokenModel;
use DateTime;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

use const src\DEVELOP;
use const src\ERROR0001;
use const src\ERROR0004;

final class AuthController {
    
    public function login(Request $request, Response $response, array $args): Response 
    {
        $data = $request->getParsedBody();
        $email = $data['email'];
        $senha = $data['senha'];
        $expiredAt = $data['expire'] ?? (new DateTime())->modify('+2 days')->format('Y-m-d H:i:s');
        
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getUsuarioPorEmail($email);

        if (is_null($usuario)) 
        {
            $result = new ExceptionController(new EclasseException(''), 'o usuário não foi informado', DEVELOP['email'], 400, ERROR0001['id'], ERROR0001['value']);
            return $result->test($request, $response, $args);
        }
            
        if (!password_verify($senha, $usuario->getSenha())) 
        {
            $result = new ExceptionController(new EclasseException(''), 'senha incorreta', DEVELOP['email'], 400, ERROR0004['id'], ERROR0004['value']);
            return $result->test($request, $response, $args);
        }

        return $this->definePayload($usuario, $expiredAt, $response);
    }

    public function refreshToken(Request $request, Response $response, array $args): Response 
    {
        $data = $request->getParsedBody();
        $refreshToken = $data['refresh_token'];
        $expiredAt = $data['expire'] ?? (new DateTime())->modify('+2 days')->format('Y-m-d H:i:s');

        $refreshTokenDecoded = JWT::decode(
            $refreshToken,
            getenv('JWT_SECRET_KEY'),
            ['HS256']
        );
        
        $tokenDAO = new TokenDAO();
        $exists = $tokenDAO->verifyRefreshToken($refreshToken);
        
        if (!$exists)
            return $response->withStatus(401);
        
        $tokenDAO->disableToken($refreshToken);
        
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getUsuarioPorEmail($refreshTokenDecoded->email);
        
        if (is_null($usuario)) 
            return $response->withStatus(401);

        return $this->definePayload($usuario, $expiredAt, $response);
    }

    public function definePayload($usuario, $expiredAt, $response) 
    {
        $tokenPayload = [
            'sub' => $usuario->getUsuarioId(),
            'email' => $usuario->getEmail(),
            'name' => $usuario->getUsuario(),
            'expired_at' => $expiredAt
        ];

        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));
        $refreshTokenPayload = [
            'email' => $usuario->getEmail(),
            'random' => uniqid()
        ];
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel
            ->setExpiredAt($expiredAt)
            ->setToken($token)
            ->setRefreshToken($refreshToken)
            ->setUsuarioId($usuario->getUsuarioId());

        $tokenDAO = new TokenDAO();
        $tokenDAO->createToken($tokenModel);

        $response = $response->withJson([
            "token" => $token,
            "refresh_token" => $refreshToken
        ]);

        return $response;
    }
}
