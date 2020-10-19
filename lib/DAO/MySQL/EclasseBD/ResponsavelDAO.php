<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\ResponsavelModel;

class ResponsavelDAO extends Connect {
    public function __construct() {
        parent::__construct();
    }

    public function find(string $table, string $query): array
    {
        $responsavel = '';
        switch ($table) {
            case 'nome':
                $responsavel = $this->_pdo->query("SELECT * FROM responsaveis WHERE lower(nome) LIKE '%$query%';")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'id':
                $responsavel = $this->_pdo->query("SELECT * FROM responsaveis WHERE id = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'documento':
                $responsavel = $this->_pdo->query("SELECT * FROM responsaveis WHERE documento = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            default:
                $responsavel = $this->_pdo->query("SELECT * FROM responsaveis;")->fetchAll(\PDO::FETCH_ASSOC);
                break;
        }
        return $responsavel;
    }

    public function insertResponsavel(ResponsavelModel $responsavel): void
    {
        $statement = $this->_pdo->prepare(
            'INSERT INTO responsaveis
            (
                id,
                nome,
                telefone,
                email,
                documento,
                documento_id,
                ativo,
                endereco,
                created_at,
                updated_at
            )
            VALUES
            (
                null,
                :nome,
                :telefone,
                :email,
                :documento,
                :documento_id,
                :ativo,
                :endereco,
                :created_at,
                :updated_at
            );
        '
        );
        $statement->execute([
            'nome' => $responsavel->getNome(),
            'telefone' => $responsavel->getTelefone(),
            'email' => $responsavel->getEmail(),
            'documento' => $responsavel->getDocumento(),
            'documento_id' => $responsavel->getDocumentoId(),
            'ativo' => $responsavel->getAtivo(),
            'endereco' => $responsavel->getEndereco(),
            'created_at' => $responsavel->getCreatedAt(),
            'updated_at' => $responsavel->getUpdatedAt()
        ]);
    }

    public function putResponsavel(ResponsavelModel $responsavel, int $query): void
    {
        $statement = $this->_pdo->prepare(
            'UPDATE responsaveis
            SET
                nome = :nome,
                telefone = :telefone,
                email = :email,
                documento = :documento,
                documento_id = :documento_id,
                ativo = :ativo,
                endereco = :endereco,
                updated_at = :updated_at
            WHERE id = :id;'
        );
        $statement->execute([
            'id' => $query,
            'nome' => $responsavel->getNome(),
            'telefone' => $responsavel->getTelefone(),
            'email' => $responsavel->getEmail(),
            'documento' => $responsavel->getDocumento(),
            'documento_id' => $responsavel->getDocumentoId(),
            'ativo' => $responsavel->getAtivo(),
            'endereco' => $responsavel->getEndereco(),
            'updated_at' => $responsavel->getUpdatedAt()
        ]);
    }

    public function patchResponsavel(ResponsavelModel $responsavel, array $columns, int $query): void
    {
        /**
         * Tirando o identificador id das colulas de query
         */
        array_shift($columns);

        $set = 'updated_at = :updated_at, ';
        $execute = ['updated_at' => $responsavel->getUpdatedAt()];
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
            "UPDATE responsaveis
            SET
                $set
            WHERE id = $query;"
        );
        $statement->execute($execute);
    }

    public function deleteAluno(int $id): void
    {
        $statement = $this->_pdo->prepare('DELETE FROM responsaveis WHERE id = :id');

        $statement->execute([
            'id' => $id,
        ]);
    }
}
