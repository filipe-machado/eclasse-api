<?php
/*
 * Responsavel
 */
namespace App\Models\MySQL\EclasseBD;

/*
 * Responsavel
 */
class ResponsavelModel {
    /* @var int $id  */
    private $id;
    /* @var string $nome  */
    private $nome;
    /* @var string $email  */
    private $email;
    /* @var string $telefone  */
    private $telefone;
    /* @var string $endereco  */
    private $endereco;
    /* @var string $documento  */
    private $documento;
    /* @var int $documento_id  */
    private $documento_id;
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
    public function setId(int $id): ResponsavelModel
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
    public function setNome(string $nome): ResponsavelModel
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
    public function setEmail(string $email): ResponsavelModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone(): string
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return self
     */
    public function setTelefone(string $telefone): ResponsavelModel
    {
        $this->telefone = $telefone;
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
    public function setEndereco(string $endereco): ResponsavelModel
    {
        $this->endereco = $endereco;
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
    public function setDocumento(string $documento): ResponsavelModel
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
    public function setDocumentoId(int $documento_id): ResponsavelModel
    {
        $this->documento_id = $documento_id;
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
    public function setAtivo(int $ativo): ResponsavelModel
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
    public function setCreatedAt(string $created_at): ResponsavelModel
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
    public function setUpdatedAt(string $updated_at): ResponsavelModel
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
