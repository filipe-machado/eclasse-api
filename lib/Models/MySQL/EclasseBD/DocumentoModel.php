<?php
/*
 * Documento
 */
namespace App\Models\MySQL\EclasseBD;

/*
 * Documento
 */
class DocumentoModel {
    /* @var int $id  */
    private $id;
    /* @var string $nome  */
    private $nome;
    /* @var int $ativo  */
    private $ativo;
    /* @var string $criado_em  */
    private $criado_em;
    /* @var string $atualizado_em  */
    private $atualizado_em;

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
    public function setId(int $id): DocumentoModel
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
     * @param int $nome
     * @return self
     */ 
    public function setNome(string $nome): DocumentoModel
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
     * @param int $ativo
     * @return self
     */ 
    public function setAtivo(int $ativo): DocumentoModel
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return string
     */ 
    public function getCriadoEm(): string
    {
        return $this->criado_em;
    }

    /**
     * @param string $criado_em
     * @return self
     */ 
    public function setCriadoEm(string $criado_em): DocumentoModel
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
    public function setAtualizadoEm(string $atualizado_em): DocumentoModel
    {
        $this->atualizado_em = $atualizado_em;
        return $this;
    }
}
