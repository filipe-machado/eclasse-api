<?php
/*
 * Group
 */

namespace App\Models\MySQL\EclasseBD;

/*
 * Group
 */

class GrupoModel
{
  /* @var int $id  */
  private $id;
  /* @var string $permissoes  */
  private $permissoes;
  /* @var string $nome  */
  private $nome;
  /* @var int $ativo  */
  private $ativo;
  /* @var string $created_at  */
  private $created_at;
  /* @var string $updated_at  */
  private $updated_at;

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
  public function setId(int $id): GrupoModel
  {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getPermissoes(): string
  {
    return $this->permissoes;
  }

  /**
   * @param string $permissoes
   * @return self
   */
  public function setPermissoes(string $permissoes): GrupoModel
  {
    $this->permissoes = $permissoes;
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
  public function setNome(string $nome): GrupoModel
  {
    $this->nome = $nome;
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
   * @param int $updated_at
   * @return self
   */
  public function setAtivo(int $ativo): GrupoModel
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
   * @param string $updated_at
   * @return self
   */
  public function setCreatedAt(string $created_at): GrupoModel
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
  public function setUpdatedAt(string $updated_at): GrupoModel
  {
    $this->updated_at = $updated_at;
    return $this;
  }
}
