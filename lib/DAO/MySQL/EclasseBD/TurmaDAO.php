<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\TurmaModel;

class TurmaDAO extends Connect {
    public function __construct() {
        parent::__construct();
    }

    public function find(string $table, string $query): array
    {
        $turma = '';
        switch ($table) {
            case 'nome':
                $turma = $this->_pdo->query("SELECT * FROM turmas WHERE nome LIKE \"%$query%\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'id':
                $turma = $this->_pdo->query("SELECT * FROM turmas WHERE id = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            default:
                $turma = $this->_pdo->query("SELECT * FROM turmas;")->fetchAll(\PDO::FETCH_ASSOC);
                break;
        }
        return $turma;
    }

    public function insertTurma(TurmaModel $turma): void
    {
        $statement = $this->_pdo->prepare(
            'INSERT INTO turmas 
                (
                    id,
                    nome,
                    ativo,
                    created_at,
                    updated_at
                )
            VALUES(
                null,
                :nome,
                :ativo,
                :created,
                :updated
        );'
        );

        $statement->execute([
            'nome' => $turma->getNome(),
            'ativo' => $turma->getAtivo(),
            'created' => $turma->getCreatedAt(),
            'updated' => $turma->getUpdatedAt()
        ]);
    }

    public function putTurma(TurmaModel $turma, int $query): void
    {
        $statement = $this->_pdo->prepare(
            'UPDATE turmas 
            SET
                nome = :nome,
                ativo = :ativo,
                updated_at = :updated_at
            WHERE id = :id;'
        );
        $statement->execute([
            'id' => $query,
            'nome' => $turma->getNome(),
            'ativo' => $turma->getAtivo(),
            'updated_at' => $turma->getUpdatedAt()
        ]);
    }

    public function patchTurma(TurmaModel $turma, array $columns, int $query): void
    {
        /**
         * Tirando o identificador id das colulas de query
         */
        array_shift($columns);

        $set = 'updated_at = :updated_at, ';
        $execute = ['updated_at' => $turma->getUpdatedAt()];
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
            "UPDATE turmas 
            SET
                $set
            WHERE id = $query;"
        );
        $statement->execute($execute);
    }

    public function deleteTurma(int $id): void
    {
        $statement = $this->_pdo->prepare('DELETE FROM turmas WHERE id = :id');
        $statement->execute([
            'id' => $id,
        ]);
    }
}