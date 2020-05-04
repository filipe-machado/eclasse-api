/**
 * Para criar as tabelas, execute todo o SQL abaixo 
 * cada tabela deve ser executada separadamente
 * basta exetar na ordem descrita
 * PS: Este SQL é para POSTGRE
 */


/* DROP TABLE IF EXISTS documentos;
CREATE TABLE IF NOT EXISTS documentos (
  id SERIAL,
  nome VARCHAR (64) NOT NULL,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  UNIQUE(id)
);

DROP TABLE IF EXISTS diretores;
CREATE TABLE IF NOT EXISTS diretores (
  id SERIAL,
  nome VARCHAR (64) NOT NULL,
  email VARCHAR (64) NOT NULL UNIQUE,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  inicio VARCHAR (12),
  documento VARCHAR (64),
  documento_id INTEGER REFERENCES documentos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);

DROP TABLE IF EXISTS instituicoes;
CREATE TABLE IF NOT EXISTS instituicoes (
  id SERIAL,
  nome VARCHAR (64) NOT NULL,
  cidade VARCHAR (64) NOT NULL,
  email VARCHAR (64) NOT NULL UNIQUE,
  uf VARCHAR (2) NOT NULL,
  endereco VARCHAR (64),
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  diretor_id INTEGER REFERENCES diretores(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS turmas;
CREATE TABLE IF NOT EXISTS turmas (
  id SERIAL,
  nome VARCHAR (64) NOT NULL,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  UNIQUE(id)
);

DROP TABLE IF EXISTS professores;
CREATE TABLE IF NOT EXISTS professores (
  id SERIAL,
  nome VARCHAR (64) NOT NULL,
  email VARCHAR (64) NOT NULL UNIQUE,
  fotosUrls VARCHAR (1024),
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  documento VARCHAR (64),
  documento_id INTEGER REFERENCES documentos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS disciplinas;
CREATE TABLE IF NOT EXISTS disciplinas (
  id SERIAL,
  nome VARCHAR (64) NOT NULL,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  UNIQUE(id)
);
DROP TABLE IF EXISTS professor_disciplina;
CREATE TABLE IF NOT EXISTS professor_disciplina (
  id SERIAL,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
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
  nome VARCHAR (64) NOT NULL,
  email VARCHAR (64) NOT NULL UNIQUE,
  endereco VARCHAR (64),
  telefone VARCHAR (64),
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  documento VARCHAR (64),
  documento_id INTEGER REFERENCES documentos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  UNIQUE(id)
);
DROP TABLE IF EXISTS grupos;
CREATE TABLE IF NOT EXISTS grupos (
  id SERIAL,
  valor INTEGER NOT NULL,
  nome VARCHAR (32),
  permissoes TEXT,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  UNIQUE(id)
);
DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios (
  id SERIAL,
  usuario VARCHAR (64) NOT NULL,
  email VARCHAR (64) NOT NULL UNIQUE,
  senha VARCHAR (256) NOT NULL,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  grupo_id INTEGER REFERENCES grupos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS alunos;
CREATE TABLE IF NOT EXISTS alunos (
  id SERIAL,
  nome VARCHAR (64) NOT NULL,
  data_nasc VARCHAR (10) NOT NULL,
  data_matricula VARCHAR (32),
  fotosUrls VARCHAR (1024),
  tipo_matricula VARCHAR (10),
  estudando INTEGER,
  finalizado INTEGER,
  transferido INTEGER,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  documento VARCHAR (64),
  documento_id INTEGER REFERENCES documentos(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
  responsavel_id INTEGER REFERENCES responsaveis(id) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    UNIQUE(id)
);
DROP TABLE IF EXISTS aluno_disciplina_turma;
CREATE TABLE IF NOT EXISTS aluno_disciplina_turma (
  id SERIAL,
  ano_letivo VARCHAR (4),
  nota_1 FLOAT(8),
  nota_2 FLOAT(8),
  nota_3 FLOAT(8),
  nota_4 FLOAT(8),
  aprovado INTEGER,
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
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
  ativo INTEGER NOT NULL DEFAULT 1,
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
  ativo INTEGER NOT NULL DEFAULT 1,
  created_at VARCHAR (32),
  updated_at VARCHAR (32),
  UNIQUE(id)
); */

ALTER TABLE grupos ADD COLUMN nome VARCHAR(32);