<?php

namespace App\Models\MySQL\EclasseBD;

final class TokenModel
{
  /** @var int */
  private $id;
  /** @var string */
  private $token;
  /** @var string */
  private $refreshToken;
  /** @var string */
  private $expired_at;
  /** @var int */
  private $usuario_id;
  /** @var int */
  private $ativo;

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
  public function setId(int $id): TokenModel
  {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getToken(): string
  {
    return $this->token;
  }

  /**
   * @param string $token
   * @return self
   */
  public function setToken(string $token): TokenModel
  {
    $this->token = $token;
    return $this;
  }

  /**
   * @return string
   */
  public function getRefreshToken(): string
  {
    return $this->refreshToken;
  }

  /**
   * @param string $refreshToken
   * @return self
   */
  public function setRefreshToken($refreshToken)
  {
    $this->refreshToken = $refreshToken;

    return $this;
  }

  /**
   * @return string
   */
  public function getExpiredAt()
  {
    return $this->expired_at;
  }

  /**
   * @param string $expired_at
   * @return self
   */
  public function setExpiredAt($expired_at): TokenModel
  {
    $this->expired_at = $expired_at;
    return $this;
  }

  /**
   * @return int
   */
  public function getUsuarioId(): int
  {
    return $this->usuario_id;
  }

  /**
   * @param int $id
   * @return self
   */
  public function setUsuarioId(int $id): TokenModel
  {
    $this->usuario_id = $id;
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
  public function setAtivo($ativo): TokenModel
  {
    $this->ativo = $ativo;
    return $this;
  }
}
