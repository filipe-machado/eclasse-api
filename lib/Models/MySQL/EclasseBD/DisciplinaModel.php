<?php
/*
 * Disciplina
 */
namespace App\Models\MySQL\EclasseBD;

/*
 * Disciplina
 */
class DisciplinaModel {
    /* @var int $id  */
    private $id;
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
    public function setId(int $id): DisciplinaModel
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
    public function setNome(string $nome): DisciplinaModel
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
    public function setAtivo(int $ativo): DisciplinaModel
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
    public function setCreatedAt(string $created_at): DisciplinaModel
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
    public function setUpdatedAt($updated_at): DisciplinaModel
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
