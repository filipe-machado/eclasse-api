<?php

namespace App\DAO\MySQL\EclasseBD;
use App\DAO\MySQL\EclasseBD\Connect;
use App\Models\MySQL\EclasseBD\TokenModel;

class TokenDAO extends Connect{
    public function __construct() {
        parent::__construct();
    }

    public function createToken(TokenModel $token) {
        $statement = $this->_pdo
            ->prepare(
                'INSERT INTO
                    tokens
                    (
                        token,
                        refresh_token,
                        expired_at,
                        usuario_id
                    )
                VALUES
                (
                    :token,
                    :refresh_token,
                    :expired_at,
                    :usuario_id
                )'
            );
        $statement->execute([
            'token' => $token->getToken(),
            'refresh_token' => $token->getRefreshToken(),
            'expired_at' => $token->getExpiredAt(),
            'usuario_id' => $token->getUsuarioId()
        ]);
    }

    public function verifyRefreshToken(string $refreshToken): bool {
        $statement = $this->_pdo
            ->prepare(
                "SELECT 
                    id
                FROM tokens
                WHERE refresh_token = :refresh_token
                AND ativo = 1;"
            );
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
        $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return count($tokens) === 0 ? false : true;
    }

    public function disableToken(string $refreshToken) {
        $statement = $this->_pdo
            ->prepare(
                "UPDATE 
                    tokens
                SET ativo = 0
                WHERE refresh_token = :refresh_token
                AND ativo = 1;"
            );
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
    }

    public function deleteToken(string $refreshToken)
    {
        $statement = $this->_pdo
            ->prepare(
                "DELETE FROM
                    tokens
                WHERE token = 0;"
            );
        $statement->execute();
    }

    public function getToken(string $id): string
    {
        $statement = $this->_pdo
            ->prepare(
                "SELECT token FROM
                    tokens
                WHERE token = 1
                AND usuario_id = :id
                ;"
            );
        $statement->bindParam('id', $id);
        $statement->execute();
        $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $tokens;
    }
}
