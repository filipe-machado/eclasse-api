<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\UsuarioModel;

class UsuarioDAO extends Connect {
    public function __construct() {
        parent::__construct();
    }

    public function getAllUsuarios()
    {
        $usuarios = $this->_pdo->query(
            "SELECT * FROM usuarios")->fetchAll(\PDO::FETCH_ASSOC);
        return $usuarios;
    }

    public function getUsuario(int $query): array
    {
        $usuario = $this->_pdo->query(
            "SELECT 
                usuario,
                email,
                created_at,
                updated_at,
                ativo,
                grupo_id 
            FROM usuarios WHERE id = $query;
            ")->fetchAll(\PDO::FETCH_ASSOC);
        return $usuario;
    }

    /**
     * NOTA: Inserindo o '?' antes do tipo, é setado permissão 
     * para retornar null ao invés do tipo informado
     */
    public function getUsuarioPorEmail(string $email): ?UsuarioModel 
    {
        $statement = $this->_pdo->prepare(
            "SELECT 
                id, 
                usuario, 
                email, 
                senha 
            FROM 
                usuarios
            WHERE 
                email = :email"
        );

        $statement->bindParam('email', $email);
        $statement->execute();
        $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if (count($usuarios) === 0)
            return null;

        $usuario = new UsuarioModel();
        $usuario
            ->setUsuarioId($usuarios[0]['id'])
            ->setUsuario($usuarios[0]['usuario'])
            ->setEmail($usuarios[0]['email'])
            ->setSenha($usuarios[0]['senha'])
            ->setCriadoEm($usuarios[0]['created_at'] ?? '')
            ->setAtualizadoEm($usuarios[0]['updated_at'] ?? '');
        return $usuario;
    }

    public function find(string $table, $query)
    {
        $usuario = $this->_pdo->query(
            "SELECT
                usuario,
                email,
                created_at,
                updated_at,
                ativo,
                grupo_id 
            FROM usuarios WHERE $table LIKE \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
        return $usuario;
    }

    public function insertUsuario(UsuarioModel $usuario): void
    {
        $statement = $this->_pdo->prepare(
            "INSERT INTO usuarios VALUES(
                null,
                :usuario,
                :email,
                :senha,
                :ativo,
                :created_at,
                :updated_at,
                :grupo_id
            )"
        );
        $statement->execute([
            'usuario' => $usuario->getUsuario(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha(),
            'ativo' => $usuario->getAtivo(),
            'created_at' => $usuario->getCriadoEm(),
            'updated_at' => $usuario->getAtualizadoEm(),
            'grupo_id' => $usuario->getGrupoId()
        ]);
    }

    public function putUsuario(UsuarioModel $usuario, int $query): void
    {
        $statement = $this->_pdo->prepare(
            'UPDATE usuarios 
            SET
                usuario = :usuario,
                email = :email,
                senha = :senha,
                ativo = :ativo,
                grupo_id = :grupo_id,
                updated_at = :updated_at
            WHERE id = :id
        ');
        $statement->execute([
            'id' => $query,
            'usuario' => $usuario->getUsuario(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha(),
            'ativo' => $usuario->getAtivo(),
            'updated_at' => $usuario->getAtualizadoEm(),
            'grupo_id' => $usuario->getGrupoId()
        ]);
    }

    public function patchUsuario(UsuarioModel $usuario, array $columns, int $query): void
    {
        /**
         * Tirando o identificador id das colulas de query
         */
        array_shift($columns);

        $set = 'updated_at = :updated_at, ';
        $execute = ['updated_at' => $usuario->getAtualizadoEm()];
        $x = 1;
        $y = 1;
        foreach ($columns as $column => $value) {
            $set .= "$column = :$column";
            if ($x < count($columns)) {
                $set .= ", ";
            }
            $x++;
        }
        foreach ($columns as $key => $value) {
            $execute[$key] = $value;
        }

        $statement = $this->_pdo->prepare(
            "UPDATE usuarios 
            SET
                $set
            WHERE id = $query;"
        );
        $statement->execute($execute);
    }

    public function deleteUsuario(int $id): void
    {
        $statement = $this->_pdo->prepare('DELETE FROM usuarios WHERE id = :id');

        $statement->execute([
            'id' => $id,
        ]);
    }
}