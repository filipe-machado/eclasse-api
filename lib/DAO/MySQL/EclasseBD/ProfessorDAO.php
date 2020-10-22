<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\ProfessorModel;

class ProfessorDAO extends Connect
{
  public function __construct()
  {
    parent::__construct();
  }

  public function find(string $table, string $query): array
  {
    $professor = '';
    switch ($table) {
      case 'nome':
        $professor = $this->_pdo->query("SELECT * FROM professores WHERE lower(nome) LIKE '%$query%';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      case 'documento':
        $professor = $this->_pdo->query("SELECT * FROM professores WHERE documento = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      case 'id':
        $professor = $this->_pdo->query("SELECT * FROM professores WHERE id = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      default:
        $professor = $this->_pdo->query("SELECT * FROM professores;")->fetchAll(\PDO::FETCH_ASSOC);
        break;
    }
    return $professor;
  }

  public function insertProfessor(ProfessorModel $professor): void
  {
    $statement = $this->_pdo->prepare(
      'INSERT INTO professores
                (
                    id,
                    nome,
                    ativo,
                    created_at,
                    updated_at,
                    fotosUrls,
                    documento,
                    documento_id
                )
            VALUE(
                null,
                :nome,
                :ativo,
                :created_at,
                :updated_at,
                :fotosUrls,
                :documento,
                :documento_id
            )
        '
    );

    $statement->execute([
      'nome' => $professor->getNome(),
      'ativo' => $professor->getAtivo(),
      'created_at' => $professor->getCreatedAt(),
      'updated_at' => $professor->getUpdatedAt(),
      'fotosUrls' => $professor->getFotoUrls(),
      'documento' => $professor->getDocumento(),
      'documento_id' => $professor->getDocumentoId()
    ]);
  }

  public function putProfessor(ProfessorModel $professor, int $query): void
  {
    $statement = $this->_pdo->prepare(
      'UPDATE professores
            SET
                nome = :nome,
                ativo = :ativo,
                updated_at = :updated_at,
                fotosUrls = :fotosUrls,
                documento = :documento,
                documento_id = :documento_id
            WHERE id = :id;'
    );
    $statement->execute([
      'id' => $query,
      'nome' => $professor->getNome(),
      'ativo' => $professor->getAtivo(),
      'updated_at' => $professor->getUpdatedAt(),
      'fotosUrls' => $professor->getFotoUrls(),
      'documento' => $professor->getDocumento(),
      'documento_id' => $professor->getDocumentoId()
    ]);
  }

  public function patchProfessor(ProfessorModel $professor, array $columns, int $query): void
  {
    /**
     * Tirando o identificador id das colulas de query
     */
    array_shift($columns);

    $set = 'updated_at = :updated_at, ';
    $execute = ['updated_at' => $professor->getUpdatedAt()];
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
      "UPDATE professores
            SET
                $set
            WHERE id = $query;"
    );
    $statement->execute($execute);
  }

  public function deleteProfessor(int $id): void
  {
    $statement = $this->_pdo->prepare('DELETE FROM professores WHERE id = :id');

    $statement->execute([
      'id' => $id,
    ]);
  }
}
