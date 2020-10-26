<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\DiretorModel;

class DiretorDAO extends Connect
{
  public function __construct()
  {
    parent::__construct();
  }

  public function find(string $table, string $query): array
  {
    $diretor = '';
    switch ($table) {
      case 'nome':
        $diretor = $this->_pdo->query("SELECT * FROM diretores WHERE lower(nome) LIKE '%$query%';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      case 'documento':
        $diretor = $this->_pdo->query("SELECT * FROM diretores WHERE documento = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      case 'id':
        $diretor = $this->_pdo->query("SELECT * FROM diretores WHERE id = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      default:
        $diretor = $this->_pdo->query("SELECT * FROM diretores;")->fetchAll(\PDO::FETCH_ASSOC);
        break;
    }
    return $diretor;
  }

  public function insertDiretor(DiretorModel $diretor): void
  {
    $statement = $this->_pdo->prepare('INSERT INTO diretores (
            nome,
            email,
            ativo,
            created_at,
            updated_at,
            inicio,
            documento,
            documento_id
        ) VALUES (
            :nome,
            :email,
            :ativo,
            :created_at,
            :updated_at,
            :inicio,
            :documento,
            :documento_id
        )');

    $statement->execute([
      'nome' => $diretor->getNome(),
      'email' => $diretor->getEmail(),
      'ativo' => $diretor->getAtivo(),
      'created_at' => date('Ymd H:i:s'),
      'updated_at' => date('Ymd H:i:s'),
      'inicio' => $diretor->getInicio(),
      'documento' => $diretor->getDocumento(),
      'documento_id' => $diretor->getDocumentoId()
    ]);
  }

  public function putDiretor(DiretorModel $diretor, int $query): void
  {
    $statement = $this->_pdo->prepare(
      'UPDATE diretores
            SET
                nome = :nome,
                ativo = :ativo,
                updated_at = :updated_at,
                inicio = :inicio,
                documento = :documento,
                documento_id = :documento_id
            WHERE id = :id;'
    );
    $statement->execute([
      'id' => $query,
      'nome' => $diretor->getNome(),
      'ativo' => $diretor->getAtivo(),
      'updated_at' => $diretor->getUpdatedAt(),
      'inicio' => $diretor->getInicio(),
      'documento' => $diretor->getDocumento(),
      'documento_id' => $diretor->getDocumentoId()
    ]);
  }

  public function patchDiretor(DiretorModel $diretor, array $columns, int $query): void
  {
    /**
     * Tirando o identificador id das colulas de query
     */
    array_shift($columns);

    $set = 'updated_at = :updated_at, ';
    $execute = ['updated_at' => $diretor->getUpdatedAt()];
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
      "UPDATE diretores
            SET
                $set
            WHERE id = $query;"
    );
    $statement->execute($execute);
  }

  public function deleteDiretor(int $id): void
  {
    $statement = $this->_pdo->prepare('DELETE FROM diretores WHERE id = :id');

    $statement->execute([
      'id' => $id,
    ]);
  }
}
