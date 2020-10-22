<?php

namespace App\Models\MySQL\EclasseBD;

class ResponsavelAlunoModel
{
  /* @var int $id  */
  private $id;
  /* @var array $dependentes */
  private $dependentes;

  /**
   * @return int
   */
  public function getId(int $id): int
  {
    return $this->id;
  }

  /**
   * @param int $id
   * @return self
   */
  private function setId(int $id): ResponsavelAlunoModel
  {
    $this->id = $id;
    return $this;
  }

  /**
   * @return array
   */
  public function getDependentes(array $dependentes): array
  {
    return $this->dependentes;
  }

  /**
   * @param array $dependentes
   * @return self
   */
  private function setDependentes(array $dependentes): ResponsavelAlunoModel
  {
    $this->dependentes = $dependentes;
  }
}
