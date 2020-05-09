<?php

namespace App\DAO\MySQL\EclasseBD;
use App\Models\MySQL\EclasseBD\InstituicaoModel;

class InstituicaoDAO extends Connect 
{

    public function __construct() 
    {
        parent::__construct();
    }

    public function find(string $table, string $query): array
    {
        $instituicao = '';
        switch ($table) {
            case 'nome':
                // PHP7.3 or above -> '%$query%'
                $instituicao = $this->_pdo->query("SELECT id, nome, email, endereco, cidade, uf FROM instituicoes WHERE lower(nome) LIKE '%$query%';")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'cidade':
                $instituicao = $this->_pdo->query("SELECT id, nome, email, endereco, cidade, uf FROM instituicoes WHERE cidade LIKE '%$query%';")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'id':
                 $instituicao = $this->_pdo->query("SELECT id, nome, email, endereco, cidade, uf FROM instituicoes WHERE id=$query;")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            case 'uf':
                $instituicao = $this->_pdo->query("SELECT id, nome, email, endereco, cidade, uf FROM instituicoes WHERE uf = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
                break;
            default:
                $instituicao = $this->_pdo->query("SELECT id, nome, email, endereco, cidade, uf FROM instituicoes;")->fetchAll(\PDO::FETCH_ASSOC);
                break;
        }
        return $instituicao;
    }

    public function insertInstituicao(InstituicaoModel $instituicao): void 
    {
        $statement = $this->_pdo->prepare(
            'INSERT INTO instituicoes 
                (
                    nome,
                    email,
                    cidade,
                    uf,
                    endereco,
                    ativo,
                    created_at,
                    updated_at,
                    diretor_id
                )
            VALUES(
                :nome,
                :email,
                :cidade,
                :uf,
                :endereco,
                :ativo,
                :created,
                :updated,
                :diretor_id
        );');
        
        $statement->execute([
            'nome' => $instituicao->getNome(),
            'email' => $instituicao->getEmail(),
            'cidade' => $instituicao->getCidade(),
            'uf' => $instituicao->getUf(),
            'endereco' => $instituicao->getEndereco(),
            'ativo' => $instituicao->getAtivo(),
            'created' => $instituicao->getCriadoEm(),
            'updated' => $instituicao->getAtualizadoEm(),
            'diretor_id' => $instituicao->getDiretorId()
        ]);
    }

    public function putInstituicao(InstituicaoModel $instituicao, int $query): void
    {
        $statement = $this->_pdo->prepare(
            'UPDATE instituicoes 
            SET
                nome = :nome,
                cidade = :cidade,
                uf = :uf,
                endereco = :endereco,
                ativo = :ativo,
                updated_at = :updated_at,
                diretor_id = :diretor_id
            WHERE id = :id;'
        );
        $statement->execute([
            'id' => $query,
            'nome' => $instituicao->getNome(),
            'cidade' => $instituicao->getCidade(),
            'uf' => $instituicao->getUf(),
            'endereco' => $instituicao->getEndereco(),
            'ativo' => $instituicao->getAtivo(),
            'updated_at' => $instituicao->getAtualizadoEm(),
            'diretor_id' => $instituicao->getDiretorId()
        ]);
    }

    public function patchInstituicao(InstituicaoModel $instituicao, array $columns, int $query): void
    {
        /**
         * Tirando o identificador id das colulas de query
         */
        array_shift($columns);

        $set = 'updated_at = :updated_at, ';
        $execute = ['updated_at' => $instituicao->getAtualizadoEm()];
        $x = 1;
        $y = 1;
        foreach ($columns as $column => $value) 
        {
            $set .= "$column = :$column";
            if ($x < count($columns)) 
            {
                $set .= ", ";
            }
            $x++;
        }
        foreach ($columns as $key => $value) 
        {
            $execute[$key] = $value;
        }
        
        $statement = $this->_pdo->prepare(
            "UPDATE instituicoes 
            SET
                $set
            WHERE id = $query;"
        );        
        $statement->execute($execute);
    }

    public function deleteInstituicao(int $id): void 
    {
        $statement = $this->_pdo->prepare('DELETE FROM instituicoes WHERE id = :id');

        $statement->execute([
            'id' => $id,
        ]);
    }
}