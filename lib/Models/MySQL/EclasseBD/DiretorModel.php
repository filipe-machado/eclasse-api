<?php
/*
 * Diretor
 */
namespace App\Models\MySQL\EclasseBD;

/*
 * Diretor
 */
final class DiretorModel {
    /* @var int $id  */
    private $id;
    /* @var string $nome  */
    private $nome;
    /* @var string $email  */
    private $email;
    /* @var int $ativo  */
    private $ativo;
    /* @var string $created_at  */
    private $created_at;
    /* @var string $updated_at  */
    private $updated_at;
    /* @var string $inicio  */
    private $inicio;
    /* @var string $documento  */
    private $documento;
    /* @var int $documento_id  */
    private $documento_id;


    /**
     * @return int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return self
     */ 
    public function setId(int $id): DiretorModel
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
    public function setNome(string $nome): DiretorModel
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
    public function setEmail(string $email): DiretorModel
    {
        $this->email = $email;
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
    public function setAtivo(int $ativo): DiretorModel
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
    public function setCreatedAt(string $created_at): DiretorModel
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
    public function setUpdatedAt(string $updated_at): DiretorModel
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return string
     */ 
    public function getInicio(): string
    {
        return $this->inicio;
    }

    /**
     * @param string $inicio
     * @return self
     */ 
    public function setInicio(string $inicio): DiretorModel
    {
        $this->inicio = $inicio;
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
    public function setDocumento(string $documento): DiretorModel
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
    public function setDocumentoId(int $documento_id): DiretorModel
    {
        $this->documento_id = $documento_id;
        return $this;
    }
}
