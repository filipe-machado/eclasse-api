<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\GrupoModel;

class GrupoDAO extends Connect {
    public function __construct() {
        parent::__construct();
    }

    public function find(string $table, string $query): array
    {
        $grupo = '';
        switch ($table) {
            case 'ativo':
                $grupo = $this->_pdo->query("SELECT * FROM grupos WHERE ativo = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'valor':
                $grupo = $this->_pdo->query("SELECT * FROM grupos WHERE valor = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'id':
                $grupo = $this->_pdo->query("SELECT * FROM grupos WHERE id = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            default:
                $grupo = $this->_pdo->query("SELECT * FROM grupos;")->fetchAll(\PDO::FETCH_ASSOC);
                break;
        }
        return $grupo;
    }

    public function insertGrupo(GrupoModel $grupo): void
    {
        $statement = $this->_pdo->prepare(
            'INSERT INTO grupos
                (
                    id,
                    ativo,
                    valor,
                    permissoes,
                    created_at,
                    updated_at
                )  
            VALUE(
                null, 
                :ativo,
                :valor,
                :permissoes,
                :created_at,
                :updated_at
            )
        '
        );

        $statement->execute([
            'ativo' => $grupo->getAtivo(),
            'valor' => $grupo->getValor(),
            'permissoes' => $grupo->getPermissoes(),
            'created_at' => $grupo->getCreatedAt(),
            'updated_at' => $grupo->getUpdatedAt()
        ]);
    }

    public function putGrupo(GrupoModel $grupo, int $query): void
    {
        $statement = $this->_pdo->prepare(
            'UPDATE grupos 
            SET
                ativo = :ativo,
                valor = :valor,
                permissoes = :permissoes,
                updated_at = :updated_at
            WHERE id = :id;'
        );
        $statement->execute([
            'id' => $query,
            'ativo' => $grupo->getAtivo(),
            'valor' => $grupo->getValor(),
            'permissoes' => $grupo->getPermissoes(),
            'updated_at' => $grupo->getUpdatedAt()
        ]);
    }

    public function patchGrupo(GrupoModel $grupo, array $columns, int $query): void
    {
        /**
         * Tirando o identificador id das colulas de query
         */
        array_shift($columns);

        $set = 'updated_at = :updated_at, ';
        $execute = ['updated_at' => $grupo->getUpdatedAt()];
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
            "UPDATE grupos 
            SET
                $set
            WHERE id = $query;"
        );
        $statement->execute($execute);
    }

    public function deleteGrupo(int $id): void
    {
        $statement = $this->_pdo->prepare('DELETE FROM grupos WHERE id = :id');

        $statement->execute([
            'id' => $id,
        ]);
    }
}