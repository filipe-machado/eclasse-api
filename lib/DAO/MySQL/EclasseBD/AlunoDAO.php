<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\AlunoModel;

class AlunoDAO extends Connect {
    public function __construct() {
        parent::__construct();
    }

    public function find(string $table, string $query): array
    {
        $aluno = '';
        switch ($table) {
            case 'nome':
                $aluno = $this->_pdo->query("SELECT * FROM alunos WHERE nome LIKE \"%$query%\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'id':
                $aluno = $this->_pdo->query("SELECT * FROM alunos WHERE id = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'documento':
                $aluno = $this->_pdo->query("SELECT * FROM alunos WHERE documento = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'estudando':
                $aluno = $this->_pdo->query("SELECT * FROM alunos WHERE estudando = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'finalizado':
                $aluno = $this->_pdo->query("SELECT * FROM alunos WHERE finalizado = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'transferido':
                $aluno = $this->_pdo->query("SELECT * FROM alunos WHERE transferido = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'tipo_matricula':
                $aluno = $this->_pdo->query("SELECT * FROM alunos WHERE tipo_matricula = \"$query\";")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            default:
                $aluno = $this->_pdo->query("SELECT * FROM alunos;")->fetchAll(\PDO::FETCH_ASSOC);
                break;
        }
        return $aluno;
    }

    public function insertAluno(AlunoModel $aluno): void
    {
        $statement = $this->_pdo->prepare(
            'INSERT INTO alunos 
            (
                id,
                nome,
                data_nasc,
                data_matricula,
                estudando,
                transferido,
                fotosUrls,
                documento,
                documento_id,
                finalizado,
                ativo,
                tipo_matricula,
                created_at,
                updated_at,
                responsavel_id
            )
            VALUES
            (
                null,
                :nome,
                :data_nasc,
                :data_matricula,
                :estudando,
                :transferido,
                :fotoUrls,
                :documento,
                :documento_id,
                :finalizado,
                :ativo,
                :tipo_matricula,
                :created_at,
                :updated_at,
                :responsavel_id
            );
        ');
        $statement->execute([
            'nome' => $aluno->getNome(),
            'data_nasc' => $aluno->getDataNasc(),
            'data_matricula' => $aluno->getDataMatricula(),
            'estudando' => $aluno->getEstudando(),
            'transferido' => $aluno->getTransferido(),
            'fotoUrls' => $aluno->getFotoUrls(),
            'documento' => $aluno->getDocumento(),
            'documento_id' => $aluno->getDocumentoId(),
            'finalizado' => $aluno->getFinalizado(),
            'ativo' => $aluno->getAtivo(),
            'tipo_matricula' => $aluno->getTipoMatricula(),
            'created_at' => $aluno->getCreatedAt(),
            'updated_at' => $aluno->getUpdatedAt(),
            'responsavel_id' => $aluno->getResponsavelId()
        ]);
    }

    public function putAluno(AlunoModel $aluno, int $query): void
    {
        $statement = $this->_pdo->prepare(
            'UPDATE alunos 
            SET
                nome = :nome,
                data_nasc = :data_nasc,
                data_matricula = :data_matricula,
                estudando = :estudando,
                transferido = :transferido,
                fotosUrls = :fotosUrls,
                documento = :documento,
                documento_id = :documento_id,
                finalizado = :finalizado,
                ativo = :ativo,
                tipo_matricula = :tipo_matricula,
                updated_at = :updated_at,
                responsavel_id = :responsavel_id
            WHERE id = :id;'
        );
        $statement->execute([
            'id' => $query,
            'nome' => $aluno->getNome(),
            'data_nasc' => $aluno->getDataNasc(),
            'data_matricula' => $aluno->getDataMatricula(),
            'estudando' => $aluno->getEstudando(),
            'transferido' => $aluno->getTransferido(),
            'fotosUrls' => $aluno->getFotoUrls(),
            'documento' => $aluno->getDocumento(),
            'documento_id' => $aluno->getDocumentoId(),
            'finalizado' => $aluno->getFinalizado(),
            'ativo' => $aluno->getAtivo(),
            'tipo_matricula' => $aluno->getTipoMatricula(),
            'updated_at' => $aluno->getUpdatedAt(),
            'responsavel_id' => $aluno->getResponsavelId()
        ]);
    }

    public function patchAluno(AlunoModel $aluno, array $columns, int $query): void
    {
        /**
         * Tirando o identificador id das colulas de query
         */
        array_shift($columns);

        $set = 'updated_at = :updated_at, ';
        $execute = ['updated_at' => $aluno->getUpdatedAt()];
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
            "UPDATE alunos 
            SET
                $set
            WHERE id = $query;"
        );
        $statement->execute($execute);
    }

    public function deleteAluno(int $id): void
    {
        $statement = $this->_pdo->prepare('DELETE FROM alunos WHERE id = :id');

        $statement->execute([
            'id' => $id,
        ]);
    }
}