<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\DocumentoModel;

class DocumentoDAO extends Connect {
    public function __construct() {
        parent::__construct();
    }

    public function find(string $table, string $query): array
    {
        $documento = '';
        switch ($table) {
            case 'nome':
                $documento = $this->_pdo->query("SELECT * FROM documentos WHERE nome LIKE '%$query%';")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'id':
                $documento = $this->_pdo->query("SELECT * FROM documentos WHERE id = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            default:
                $documento = $this->_pdo->query("SELECT * FROM documentos;")->fetchAll(\PDO::FETCH_ASSOC);
                break;
        }
        return $documento;
    }

    public function insertDocumento(DocumentoModel $documento): void
    {
        $statement = $this->_pdo->prepare('INSERT INTO documentos VALUES(
            null,
            :nome,
            :ativo,
            :created_at,
            :updated_at
        );');
        $statement->execute([
            'nome' => $documento->getNome(),
            'ativo' => $documento->getAtivo(),
            'created_at' => $documento->getCriadoEm(),
            'updated_at' => $documento->getAtualizadoEm()
        ]);
    }

    public function putDocumento(DocumentoModel $documento, int $query): void
    {
        $statement = $this->_pdo->prepare(
            'UPDATE documentos 
            SET
                nome = :nome,
                ativo = :ativo,
                updated_at = :updated_at
            WHERE id = :id;'
        );
        $statement->execute([
            'id' => $query,
            'nome' => $documento->getNome(),
            'ativo' => $documento->getAtivo(),
            'updated_at' => $documento->getAtualizadoEm()
        ]);
    }

    public function patchDocumento(DocumentoModel $documento, array $columns, int $query): void
    {
        /**
         * Tirando o identificador id das colulas de query
         */
        array_shift($columns);

        $set = 'updated_at = :updated_at, ';
        $execute = ['updated_at' => $documento->getAtualizadoEm()];
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
            "UPDATE documentos 
            SET
                $set
            WHERE id = $query;"
        );
        $statement->execute($execute);
    }

    public function deleteDocumento(int $id): void
    {
        $statement = $this->_pdo->prepare('DELETE FROM documentos WHERE id = :id');

        $statement->execute([
            'id' => $id,
        ]);
    }
}