<?php

namespace App\DAO\MySQL\EclasseBD;

use App\Models\MySQL\EclasseBD\DisciplinaModel;

class DisciplinaDAO extends Connect
{
  public function __construct()
  {
    parent::__construct();
  }

  public function find(string $table, string $query): array
  {
    $disciplina = '';
    switch ($table) {
      case 'nome':
        $disciplina = $this->_pdo->query("SELECT * FROM disciplinas WHERE nome LIKE '%$query%';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      case 'nome_exato':
        $disciplina = $this->_pdo->query("SELECT * FROM disciplinas WHERE nome = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      case 'ativo':
        $disciplina = $this->_pdo->query("SELECT * FROM disciplinas WHERE ativo = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      case 'id':
        $disciplina = $this->_pdo->query("SELECT * FROM disciplinas WHERE id = '$query';")->fetchAll(\PDO::FETCH_ASSOC);
        break;
      default:
        $disciplina = $this->_pdo->query("SELECT * FROM disciplinas;")->fetchAll(\PDO::FETCH_ASSOC);
        break;
    }
    return $disciplina;
  }

  public function insertDisciplina(DisciplinaModel $disciplina): void
  {
    $statement = $this->_pdo->prepare(
      'INSERT INTO disciplinas
                (
                    id,
                    nome,
                    ativo,
                    created_at,
                    updated_at
                )
            VALUE(
                null,
                :nome,
                :ativo,
                :created_at,
                :updated_at
            )
        '
    );

    $statement->execute([
      'nome' => $disciplina->getNome(),
      'ativo' => $disciplina->getAtivo(),
      'created_at' => $disciplina->getCreatedAt(),
      'updated_at' => $disciplina->getUpdatedAt()
    ]);
  }

  public function putDisciplina(DisciplinaModel $disciplina, int $query): void
  {
    $statement = $this->_pdo->prepare(
      'UPDATE disciplinas
            SET
                nome = :nome,
                ativo = :ativo,
                updated_at = :updated_at
            WHERE id = :id;'
    );
    $statement->execute([
      'id' => $query,
      'nome' => $disciplina->getNome(),
      'ativo' => $disciplina->getAtivo(),
      'updated_at' => $disciplina->getUpdatedAt()
    ]);
  }

  public function patchDisciplina(DisciplinaModel $disciplina, array $columns, int $query): void
  {
    /**
     * Tirando o identificador id das colulas de query
     */
    array_shift($columns);

    $set = 'updated_at = :updated_at, ';
    $execute = ['updated_at' => $disciplina->getUpdatedAt()];
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
      "UPDATE disciplinas
            SET
                $set
            WHERE id = $query;"
    );
    $statement->execute($execute);
  }

  public function deleteDisciplina(int $id): void
  {
    $statement = $this->_pdo->prepare('DELETE FROM disciplinas WHERE id = :id');

    $statement->execute([
      'id' => $id,
    ]);
  }
}
