<?php
/*
 * User
 */
namespace App\Models\MySQL\EclasseBD;

/*
 * User
 */
class UsuarioModel {
    /* @var int $id  */
    private $id;
    /* @var string $usuario  */
    private $usuario;
    /* @var string $email  */
    private $email;
    /* @var string $senha  */
    private $senha;
    /* @var int $ativo  */
    private $ativo;
    /* @var string $criado_em  */
    private $criado_em;
    /* @var string $atualizado_em  */
    private $atualizado_em;
    /* @var int $grupo_id  */
    private $grupo_id;

    /**
     * @return int
     */ 
    public function getUsuarioId(): int 
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setUsuarioId(int $id): UsuarioModel 
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */ 
    public function getUsuario(): string 
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     * @return self
     */ 
    public function setUsuario(string $usuario): UsuarioModel 
    {
        $this->usuario = $usuario;
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
    public function setEmail(string $email): UsuarioModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */ 
    public function getSenha(): string 
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * @return self
     */ 
    public function setSenha(string $senha): UsuarioModel 
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * @return int
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param int $ativo
     * @return self
     */
    public function setAtivo(int $ativo): UsuarioModel
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return string
     */ 
    public function getCriadoEm() 
    {
        return $this->criado_em;
    }

    /**
     * @param string $criado_em
     * @return self
     */ 
    public function setCriadoEm(string $criado_em): UsuarioModel 
    {
        $this->criado_em = $criado_em;
        return $this;
    }

    /**
     * @return string
     */ 
    public function getAtualizadoEm(): string 
    {
        return $this->atualizado_em;
    }

    /**
     * @param string $atualizado_em
     * @return self
     */ 
    public function setAtualizadoEm(string $atualizado_em): UsuarioModel 
    {
        $this->atualizado_em = $atualizado_em;
        return $this;
    }

    /**
     * @return int
     */ 
    public function getGrupoId(): int
    {
        return $this->grupo_id;
    }

    /**
     * @param int $grupo_id
     * @return self
     */ 
    public function setGrupoId(int $grupo_id): UsuarioModel
    {
        $this->grupo_id = $grupo_id;
        return $this;
    }
}
