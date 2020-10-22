<?php
/*
 * Instituicao
 */

namespace App\Models\MySQL\EclasseBD;

/*
 * Instituicao
 */

class InstituicaoModel
{
  /* @var string $id  */
  private $id;
  /* @var string $nome  */
  private $nome;
  /* @var string $email  */
  private $email;
  /* @var string $endereco  */
  private $endereco;
  /* @var string $cidade  */
  private $cidade;
  /* @var string $uf  */
  private $uf;
  /* @var boolean $ativo  */
  private $ativo;
  /* @var string $created_at  */
  private $created_at;
  /* @var string $updated_at  */
  private $updated_at;
  /* @var string $diretor_id  */
  private $diretor_id;

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
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
  public function setNome(string $nome): InstituicaoModel
  {
    $this->nome = $nome;
    return $this;
  }

  /**
   * @return string
   */
  public function getEmail(): string
  {
    return $this->email;
  }

  /**
   * @param string $email
   * @return self
   */
  public function setEmail(string $email): InstituicaoModel
  {
    $this->email = $email;
    return $this;
  }

  /**
   * @return string
   */
  public function getCidade(): string
  {
    return $this->cidade;
  }

  /**
   * @param string $cidade
   * @return self
   */
  public function setCidade(string $cidade): InstituicaoModel
  {
    $this->cidade = $cidade;
    return $this;
  }

  /**
   * @return string
   */
  public function getEndereco(): string
  {
    return $this->endereco;
  }

  /**
   * @param string $endereco
   * @return self
   */
  public function setEndereco(string $endereco): InstituicaoModel
  {
    $this->endereco = $endereco;
    return $this;
  }

  /**
   * @return string
   */
  public function getUf(): string
  {
    return $this->uf;
  }

  /**
   * @param string $uf
   * @return self
   */
  public function setUf(string $uf): InstituicaoModel
  {
    $this->uf = $uf;
    return $this;
  }

  /**
   * @return int
   */
  public function getDiretorId(): int
  {
    return $this->diretor_id;
  }

  /**
   * @param int $id
   * @return self
   */
  public function setDiretorId(int $id): InstituicaoModel
  {
    $this->diretor_id = $id;
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
  public function setAtivo(int $ativo): InstituicaoModel
  {
    $this->ativo = $ativo;
    return $this;
  }

  /**
   * @return string
   */
  public function getCriadoEm(): string
  {
    return $this->created_at;
  }

  /**
   * @param string $created_at
   * @return self
   */
  public function setCriadoEm(string $created_at): InstituicaoModel
  {
    $this->created_at = $created_at;
    return $this;
  }

  /**
   * @return string
   */
  public function getAtualizadoEm(): string
  {
    return $this->updated_at;
  }

  /**
   * @param string $updated_at
   * @return self
   */
  public function setAtualizadoEm(string $updated_at): InstituicaoModel
  {
    $this->updated_at = $updated_at;
    return $this;
  }
}
