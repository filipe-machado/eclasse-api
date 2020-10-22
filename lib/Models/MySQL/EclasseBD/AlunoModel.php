<?php
/*
 * Aluno
 */

namespace App\Models\MySQL\EclasseBD;

/*
 * Aluno
 */

class AlunoModel
{
  /* @var int $id  */
  private $id;
  /* @var string $nome  */
  private $nome;
  /* @var string $data_nasc  */
  private $data_nasc;
  /* @var string $data_matricula  */
  private $data_matricula;
  /* @var int $estudando  */
  private $estudando;
  /* @var int $transferido  */
  private $transferido;
  /* @var string[] $fotoUrls  */
  private $fotoUrls;
  /* @var string $documento  */
  private $documento;
  /* @var boolean $documento_id  */
  private $documento_id;
  /* @var boolean $finalizado  */
  private $finalizado;
  /* @var boolean $ativo  */
  private $ativo;
  /* @var boolean $tipo_matricula  */
  private $tipo_matricula;
  /* @var string $created_at  */
  private $created_at;
  /* @var string $updated_at  */
  private $updated_at;
  /* @var string $responsavel_id  */
  private $responsavel_id;

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * @param int $id
   * @return self
   */
  public function setId(int $id): AlunoModel
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
  public function setNome(string $nome): AlunoModel
  {
    $this->nome = $nome;
    return $this;
  }

  /**
   * @return string
   */
  public function getDataNasc(): string
  {
    return $this->data_nasc;
  }

  /**
   * @param string $data_nasc
   * @return self
   */
  public function setDataNasc(string $data_nasc): AlunoModel
  {
    $this->data_nasc = $data_nasc;
    return $this;
  }

  /**
   * @return string
   */
  public function getDataMatricula(): string
  {
    return $this->data_matricula;
  }

  /**
   * @param string $data_matricula
   * @return self
   */
  public function setDataMatricula(string $data_matricula): AlunoModel
  {
    $this->data_matricula = $data_matricula;
    return $this;
  }

  /**
   * @return int
   */
  public function getEstudando(): int
  {
    return $this->estudando;
  }

  /**
   * @param int $estudando
   * @return self
   */
  public function setEstudando(int $estudando): AlunoModel
  {
    $this->estudando = $estudando;
    return $this;
  }

  /**
   * @return int
   */
  public function getTransferido(): int
  {
    return $this->transferido;
  }

  /**
   * @param int $transferido
   * @return self
   */
  public function setTransferido(int $transferido): AlunoModel
  {
    $this->transferido = $transferido;
    return $this;
  }

  /**
   * @return string
   */
  public function getFotoUrls(): string
  {
    return $this->fotoUrls;
  }

  /**
   * @param string $fotoUrls
   * @return self
   */
  public function setFotoUrls(string $fotoUrls): AlunoModel
  {
    $this->fotoUrls = $fotoUrls;
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
  public function setDocumento(string $documento): AlunoModel
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
  public function setDocumentoId(int $documento_id): AlunoModel
  {
    $this->documento_id = $documento_id;
    return $this;
  }

  /**
   * @return int
   */
  public function getFinalizado(): int
  {
    return $this->finalizado;
  }

  /**
   * @param int $finalizado
   * @return self
   */
  public function setFinalizado(int $finalizado): AlunoModel
  {
    $this->finalizado = $finalizado;
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
  public function setAtivo(int $ativo): AlunoModel
  {
    $this->ativo = $ativo;
    return $this;
  }

  /**
   * @return string
   */
  public function getCreatedAt(): string
  {
    return $this->created_at;
  }

  /**
   * @param string $created_at
   * @return self
   */
  public function setCreatedAt(string $created_at): AlunoModel
  {
    $this->created_at = $created_at;
    return $this;
  }

  /**
   * @return string
   */
  public function getUpdatedAt(): string
  {
    return $this->updated_at;
  }

  /**
   * @param string $updated_at
   * @return self
   */
  public function setUpdatedAt(string $updated_at): AlunoModel
  {
    $this->updated_at = $updated_at;
    return $this;
  }

  /**
   * @return int
   */
  public function getResponsavelId(): int
  {
    return $this->responsavel_id;
  }

  /**
   * @param int $responsavel_id
   * @return self
   */
  public function setResponsavelId(int $responsavel_id): AlunoModel
  {
    $this->responsavel_id = $responsavel_id;
    return $this;
  }

  /**
   * @return string
   */
  public function getTipoMatricula(): string
  {
    return $this->tipo_matricula;
  }

  /**
   * @param string $tipo_matricula
   * @return  self
   */
  public function setTipoMatricula(string $tipo_matricula): AlunoModel
  {
    $this->tipo_matricula = $tipo_matricula;
    return $this;
  }
}
