/**
 * Para criar as tabelas, execute todo o SQL abaixo 
 * cada tabela deve ser executada separadamente
 * basta exetar na ordem descrita
 * PS: Este SQL é para POSTGRE
 */


/* DROP TABLE IF EXISTS documentos;
CREATE TABLE IF NOT EXISTS documentos (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  UNIQUE(id)
);

DROP TABLE IF EXISTS diretores;
CREATE TABLE IF NOT EXISTS diretores (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  ano_inicio VARCHAR (12),
  documento_id INTEGER REFERENCES documentos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);

DROP TABLE IF EXISTS instituicoes;
CREATE TABLE IF NOT EXISTS instituicoes (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  diretor_id INTEGER REFERENCES diretores(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS turmas;
CREATE TABLE IF NOT EXISTS turmas (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  UNIQUE(id)
);

DROP TABLE IF EXISTS professores;
CREATE TABLE IF NOT EXISTS professores (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  documento_id INTEGER REFERENCES documentos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS disciplinas;
CREATE TABLE IF NOT EXISTS disciplinas (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  UNIQUE(id)
);
DROP TABLE IF EXISTS professor_disciplina;
CREATE TABLE IF NOT EXISTS professor_disciplina (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  disciplina_id INTEGER REFERENCES disciplinas(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  professor_id INTEGER REFERENCES professores(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  turma_id INTEGER REFERENCES turmas(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);

DROP TABLE IF EXISTS responsaveis;
CREATE TABLE IF NOT EXISTS responsaveis (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  documento_id INTEGER REFERENCES documentos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  UNIQUE(id)
);
DROP TABLE IF EXISTS grupos;
CREATE TABLE IF NOT EXISTS grupos (
  id SERIAL,
  permissoes TEXT,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  UNIQUE(id)
);
DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  grupo_id INTEGER REFERENCES grupos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS alunos;
CREATE TABLE IF NOT EXISTS alunos (
  id SERIAL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16)
);
DROP TABLE IF EXISTS 0;
CREATE TABLE IF NOT EXISTS aluno_disciplina_turma (
  id SERIAL,
  ano_letivo VARCHAR (4),
  nota_1 FLOAT(8),
  nota_2 FLOAT(8),
  nota_3 FLOAT(8),
  nota_4 FLOAT(8),
  aprovado INTEGER,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  aluno_id INTEGER,
  FOREIGN KEY (aluno_id) REFERENCES alunos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  disciplina_id INTEGER REFERENCES disciplinas(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  turma_id INTEGER REFERENCES turmas(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS tokens;
CREATE TABLE IF NOT EXISTS tokens (
  id SERIAL,
  token VARCHAR (1024) NOT NULL,
  refresh_token VARCHAR (1024) NOT NULL,
  expired_at VARCHAR (32),
  usuario_id INTEGER REFERENCES usuarios(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS permissoes;
CREATE TABLE IF NOT EXISTS permissoes (
  id SERIAL,
  funcionalidade VARCHAR (32) NOT NULL,
  permissoes TEXT,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  UNIQUE(id)
);

DROP TABLE IF EXISTS aluno_responsavel;
CREATE TABLE IF NOT EXISTS aluno_responsavel (
  id SERIAL,
  aluno_id INTEGER REFERENCES alunos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  responsavel_id INTEGER REFERENCES responsaveis(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
); */


/*
  TODO: ADICIONAR AS SEGUINTER REGRAS:
*/
DROP TABLE IF EXISTS entidades;
CREATE TABLE IF NOT EXISTS entidades (
  id SERIAL,
  telefone VARCHAR (64),
  data_nasc VARCHAR (16),
  data_matricula VARCHAR (32),
  data_rematricula VARCHAR (32),
  nome VARCHAR (64),
  cidade VARCHAR (64),
  uf VARCHAR (2),
  endereco VARCHAR (64),
  fotosUrls VARCHAR (1024),
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  entidade_estatus_id INTEGER REFERENCES entidade_status(id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  documento_id INTEGER REFERENCES documento(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  UNIQUE(id)
);

DROP TABLE IF EXISTS entidade_usuario;
CREATE TABLE IF NOT EXISTS entidade_usuario (
  id SERIAL,
  usuario VARCHAR (64) NOT NULL,
  senha VARCHAR (256) NOT NULL,
  email VARCHAR (64),
  created_at VARCHAR (16),
  updated_at VARCHAR (16)
  UNIQUE(id)
);

DROP TABLE IF EXISTS entidade_documento;
CREATE TABLE IF NOT EXISTS entidade_documento (
  id SERIAL,
  valor_documento VARCHAR (16),
  created_at VARCHAR (16),
  updated_at VARCHAR (16),
  documento_id INTEGER REFERENCES documento(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  pessoa_id INTEGER REFERENCES entidades(id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  UNIQUE(id)
);

DROP TABLE IF EXISTS entidade_status;
CREATE TABLE IF NOT EXISTS entidade_status (
  id SERIAL,
  status_valor VARCHAR(16) NOT NULL,
  created_at VARCHAR (16),
  updated_at VARCHAR (16),  
  UNIQUE(id)
);

DROP TABLE IF EXISTS documento_entidade;
CREATE TABLE IF NOT EXISTS documento_entidade (
  id SERIAL,
  documento VARCHAR (32),
  entidade_id INTEGER REFERENCES entidades(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  documento_id INTEGER REFERENCES documento(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  UNIQUE(id)
);

DROP TABLE IF EXISTS aluno_entidade;
CREATE TABLE IF NOT EXISTS aluno_entidade (
  id SERIAL,
  responsavel_id INTEGER REFERENCES responsaveis(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
  entidade_id INTEGER REFERENCES entidades(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  aluno_id INTEGER REFERENCES alunos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  UNIQUE(id)
);