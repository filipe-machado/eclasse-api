<?php
/*
 * Professor
 */

namespace App\Models\MySQL\EclasseBD;

/*
 * Professor
 */

class ProfessorModel
{
  /* @var string $id  */
  private $id;
  /* @var string $nome_professor  */
  private $nome;
  /* @var string $documento  */
  private $documento;
  /* @var string $documento_id  */
  private $documento_id;
  /* @var string[] $fotoUrls  */
  private $fotoUrls;
  /* @var boolean $ativo  */
  private $ativo;
  /* @var string $created_at  */
  private $created_at;
  /* @var string $updated_at  */
  private $updated_at;

  /**
   * @return string
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * @param int $id
   * @return self
   */
  public function setId(int $id): ProfessorModel
  {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getNome(): string
  {
    return $this->nome;
  }

  /**
   * @param string $nome
   * @return self
   */
  public function setNome(string $nome): ProfessorModel
  {
    $this->nome = $nome;
    return $this;
  }

  /**
   * @return string
   */
  public function getDocumento(): string
  {
    return $this->documento;
  }

  /**
   * @param string $documento
   * @return self
   */
  public function setDocumento(string $documento): ProfessorModel
  {
    $this->documento = $documento;
    return $this;
  }

  /**
   * @return int
   */
  public function getDocumentoId(): int
  {
    return $this->documento_id;
  }

  /**
   * @param int $documento_id
   * @return self
   */
  public function setDocumentoId(int $documento_id): ProfessorModel
  {
    $this->documento_id = $documento_id;
    return $this;
  }

  /**
   * @return string fotoUrls
   */
  public function getFotoUrls(): string
  {
    return $this->fotoUrls;
  }

  /**
   * @param string $fotoUrls
   * @return self
   */
  public function setFotoUrls($fotoUrls): ProfessorModel
  {
    $this->fotoUrls = $fotoUrls;
    return $this;
  }

  /**
   * @return int
   */
  public function getAtivo(): int
  {
    return $this->ativo;
  }

  /**
   * @param int $ativo
   * @return self
   */
  public function setAtivo(int $ativo): ProfessorModel
  {
    $this->ativo = $ativo;
    return $this;
  }

  /**
   * @return string created_at
   */
  public function getCreatedAt(): string
  {
    return $this->created_at;
  }

  /**
   * @param string $created_at
   * @return self
   */
  public function setCreatedAt(string $created_at): ProfessorModel
  {
    $this->created_at = $created_at;
    return $this;
  }

  /**
   * @return string updated_at
   */
  public function getUpdatedAt(): string
  {
    return $this->updated_at;
  }

  /**
   * @param string $updated_at
   * @return self
   */
  public function setUpdatedAt($updated_at): ProfessorModel
  {
    $this->updated_at = $updated_at;
    return $this;
  }
}
