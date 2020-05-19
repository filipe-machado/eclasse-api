--
-- PostgreSQL database cluster dump
--

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Roles
--

CREATE ROLE root;
ALTER ROLE root WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS PASSWORD 'md5abcd945c5dd481696a38ece3496c2353';






--
-- Databases
--

--
-- Database "template1" dump
--

\connect template1

--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2 (Debian 12.2-2.pgdg100+1)
-- Dumped by pg_dump version 12.2 (Debian 12.2-2.pgdg100+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- PostgreSQL database dump complete
--

--
-- Database "eclasse_bd" dump
--

--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2 (Debian 12.2-2.pgdg100+1)
-- Dumped by pg_dump version 12.2 (Debian 12.2-2.pgdg100+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: eclasse_bd; Type: DATABASE; Schema: -; Owner: root
--

CREATE DATABASE eclasse_bd WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE eclasse_bd OWNER TO root;

\connect eclasse_bd

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: aluno_disciplina_turma; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.aluno_disciplina_turma (
    id integer NOT NULL,
    ano_letivo character varying(4),
    nota_1 real,
    nota_2 real,
    nota_3 real,
    nota_4 real,
    aprovado integer,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    aluno_id integer,
    disciplina_id integer,
    turma_id integer
);


ALTER TABLE public.aluno_disciplina_turma OWNER TO root;

--
-- Name: aluno_disciplina_turma_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.aluno_disciplina_turma_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.aluno_disciplina_turma_id_seq OWNER TO root;

--
-- Name: aluno_disciplina_turma_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.aluno_disciplina_turma_id_seq OWNED BY public.aluno_disciplina_turma.id;


--
-- Name: aluno_responsavel; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.aluno_responsavel (
    id integer NOT NULL,
    aluno_id integer,
    responsavel_id integer
);


ALTER TABLE public.aluno_responsavel OWNER TO root;

--
-- Name: aluno_responsavel_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.aluno_responsavel_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.aluno_responsavel_id_seq OWNER TO root;

--
-- Name: aluno_responsavel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.aluno_responsavel_id_seq OWNED BY public.aluno_responsavel.id;


--
-- Name: alunos; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.alunos (
    id integer NOT NULL,
    nome character varying(64) NOT NULL,
    data_nasc character varying(10) NOT NULL,
    data_matricula character varying(32),
    fotosurls character varying(1024),
    tipo_matricula character varying(10),
    estudando integer,
    finalizado integer,
    transferido integer,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    documento character varying(64),
    documento_id integer,
    responsavel_id integer
);


ALTER TABLE public.alunos OWNER TO root;

--
-- Name: alunos_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.alunos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.alunos_id_seq OWNER TO root;

--
-- Name: alunos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.alunos_id_seq OWNED BY public.alunos.id;


--
-- Name: diretores; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.diretores (
    id integer NOT NULL,
    nome character varying(64) NOT NULL,
    email character varying(64) NOT NULL,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    inicio character varying(12),
    documento character varying(64),
    documento_id integer
);


ALTER TABLE public.diretores OWNER TO root;

--
-- Name: diretores_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.diretores_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.diretores_id_seq OWNER TO root;

--
-- Name: diretores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.diretores_id_seq OWNED BY public.diretores.id;


--
-- Name: disciplinas; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.disciplinas (
    id integer NOT NULL,
    nome character varying(64) NOT NULL,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32)
);


ALTER TABLE public.disciplinas OWNER TO root;

--
-- Name: disciplinas_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.disciplinas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.disciplinas_id_seq OWNER TO root;

--
-- Name: disciplinas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.disciplinas_id_seq OWNED BY public.disciplinas.id;


--
-- Name: documentos; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.documentos (
    id integer NOT NULL,
    nome character varying(64) NOT NULL,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32)
);


ALTER TABLE public.documentos OWNER TO root;

--
-- Name: documentos_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.documentos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.documentos_id_seq OWNER TO root;

--
-- Name: documentos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.documentos_id_seq OWNED BY public.documentos.id;


--
-- Name: grupos; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.grupos (
    id integer NOT NULL,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    nome character varying(32),
    permissoes text
);


ALTER TABLE public.grupos OWNER TO root;

--
-- Name: grupos_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.grupos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupos_id_seq OWNER TO root;

--
-- Name: grupos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.grupos_id_seq OWNED BY public.grupos.id;


--
-- Name: instituicoes; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.instituicoes (
    id integer NOT NULL,
    nome character varying(64) NOT NULL,
    cidade character varying(64) NOT NULL,
    email character varying(64) NOT NULL,
    uf character varying(2) NOT NULL,
    endereco character varying(64),
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    diretor_id integer
);


ALTER TABLE public.instituicoes OWNER TO root;

--
-- Name: instituicoes_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.instituicoes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.instituicoes_id_seq OWNER TO root;

--
-- Name: instituicoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.instituicoes_id_seq OWNED BY public.instituicoes.id;


--
-- Name: permissoes; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.permissoes (
    id integer NOT NULL,
    funcionalidade character varying(32) NOT NULL,
    permissoes text,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32)
);


ALTER TABLE public.permissoes OWNER TO root;

--
-- Name: permissoes_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.permissoes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissoes_id_seq OWNER TO root;

--
-- Name: permissoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.permissoes_id_seq OWNED BY public.permissoes.id;


--
-- Name: professor_disciplina; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.professor_disciplina (
    id integer NOT NULL,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    disciplina_id integer,
    professor_id integer,
    turma_id integer
);


ALTER TABLE public.professor_disciplina OWNER TO root;

--
-- Name: professor_disciplina_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.professor_disciplina_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.professor_disciplina_id_seq OWNER TO root;

--
-- Name: professor_disciplina_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.professor_disciplina_id_seq OWNED BY public.professor_disciplina.id;


--
-- Name: professores; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.professores (
    id integer NOT NULL,
    nome character varying(64) NOT NULL,
    email character varying(64) NOT NULL,
    fotosurls character varying(1024),
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    documento character varying(64),
    documento_id integer
);


ALTER TABLE public.professores OWNER TO root;

--
-- Name: professores_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.professores_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.professores_id_seq OWNER TO root;

--
-- Name: professores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.professores_id_seq OWNED BY public.professores.id;


--
-- Name: responsaveis; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.responsaveis (
    id integer NOT NULL,
    nome character varying(64) NOT NULL,
    email character varying(64) NOT NULL,
    endereco character varying(64),
    telefone character varying(64),
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    documento character varying(64),
    documento_id integer
);


ALTER TABLE public.responsaveis OWNER TO root;

--
-- Name: responsaveis_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.responsaveis_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.responsaveis_id_seq OWNER TO root;

--
-- Name: responsaveis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.responsaveis_id_seq OWNED BY public.responsaveis.id;


--
-- Name: tokens; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.tokens (
    id integer NOT NULL,
    token character varying(1024) NOT NULL,
    refresh_token character varying(1024) NOT NULL,
    expired_at character varying(32),
    usuario_id integer
);


ALTER TABLE public.tokens OWNER TO root;

--
-- Name: tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.tokens_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tokens_id_seq OWNER TO root;

--
-- Name: tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.tokens_id_seq OWNED BY public.tokens.id;


--
-- Name: turmas; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.turmas (
    id integer NOT NULL,
    nome character varying(64) NOT NULL,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32)
);


ALTER TABLE public.turmas OWNER TO root;

--
-- Name: turmas_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.turmas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.turmas_id_seq OWNER TO root;

--
-- Name: turmas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.turmas_id_seq OWNED BY public.turmas.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    usuario character varying(64) NOT NULL,
    email character varying(64) NOT NULL,
    senha character varying(256) NOT NULL,
    ativo integer DEFAULT 1 NOT NULL,
    created_at character varying(32),
    updated_at character varying(32),
    grupo_id integer
);


ALTER TABLE public.usuarios OWNER TO root;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_seq OWNER TO root;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- Name: aluno_disciplina_turma id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_disciplina_turma ALTER COLUMN id SET DEFAULT nextval('public.aluno_disciplina_turma_id_seq'::regclass);


--
-- Name: aluno_responsavel id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_responsavel ALTER COLUMN id SET DEFAULT nextval('public.aluno_responsavel_id_seq'::regclass);


--
-- Name: alunos id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.alunos ALTER COLUMN id SET DEFAULT nextval('public.alunos_id_seq'::regclass);


--
-- Name: diretores id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.diretores ALTER COLUMN id SET DEFAULT nextval('public.diretores_id_seq'::regclass);


--
-- Name: disciplinas id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.disciplinas ALTER COLUMN id SET DEFAULT nextval('public.disciplinas_id_seq'::regclass);


--
-- Name: documentos id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.documentos ALTER COLUMN id SET DEFAULT nextval('public.documentos_id_seq'::regclass);


--
-- Name: grupos id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grupos ALTER COLUMN id SET DEFAULT nextval('public.grupos_id_seq'::regclass);


--
-- Name: instituicoes id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.instituicoes ALTER COLUMN id SET DEFAULT nextval('public.instituicoes_id_seq'::regclass);


--
-- Name: permissoes id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.permissoes ALTER COLUMN id SET DEFAULT nextval('public.permissoes_id_seq'::regclass);


--
-- Name: professor_disciplina id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professor_disciplina ALTER COLUMN id SET DEFAULT nextval('public.professor_disciplina_id_seq'::regclass);


--
-- Name: professores id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professores ALTER COLUMN id SET DEFAULT nextval('public.professores_id_seq'::regclass);


--
-- Name: responsaveis id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.responsaveis ALTER COLUMN id SET DEFAULT nextval('public.responsaveis_id_seq'::regclass);


--
-- Name: tokens id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.tokens ALTER COLUMN id SET DEFAULT nextval('public.tokens_id_seq'::regclass);


--
-- Name: turmas id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.turmas ALTER COLUMN id SET DEFAULT nextval('public.turmas_id_seq'::regclass);


--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- Data for Name: aluno_disciplina_turma; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.aluno_disciplina_turma (id, ano_letivo, nota_1, nota_2, nota_3, nota_4, aprovado, ativo, created_at, updated_at, aluno_id, disciplina_id, turma_id) FROM stdin;
\.


--
-- Data for Name: aluno_responsavel; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.aluno_responsavel (id, aluno_id, responsavel_id) FROM stdin;
\.


--
-- Data for Name: alunos; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.alunos (id, nome, data_nasc, data_matricula, fotosurls, tipo_matricula, estudando, finalizado, transferido, ativo, created_at, updated_at, documento, documento_id, responsavel_id) FROM stdin;
\.


--
-- Data for Name: diretores; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.diretores (id, nome, email, ativo, created_at, updated_at, inicio, documento, documento_id) FROM stdin;
2	Diretor Provisório	email@email.com	1	20200504 19:20:09	20200504 19:20:09	2018	000000	1
\.


--
-- Data for Name: disciplinas; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.disciplinas (id, nome, ativo, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: documentos; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.documentos (id, nome, ativo, created_at, updated_at) FROM stdin;
1	cpf	1	20200504 19:13:58	20200504 19:13:58
\.


--
-- Data for Name: grupos; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.grupos (id, ativo, created_at, updated_at, nome, permissoes) FROM stdin;
1	1	20200504 09:42:00	20200510 02:59:44	administrador	alunos, professores, usuários, instituições, documentos, disciplinas, diretores, responsáveis, turmas, grupos
2	1	20200504 10:26:22	20200510 03:01:36	diretor	alunos, professores, instituições, documentos, disciplinas, diretores, responsáveis, turmas
3	1	20200504 10:27:04	20200510 03:01:46	professor	alunos, professores, documentos, disciplinas, responsáveis, turmas
4	1	20200504 12:25:47	20200510 03:01:54	responsável	alunos, professores, documentos, disciplinas
5	1	20200504 12:27:14	20200510 03:01:58	secretário	alunos, professores, usuários, documentos, disciplinas, responsáveis, turmas
\.


--
-- Data for Name: instituicoes; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.instituicoes (id, nome, cidade, email, uf, endereco, ativo, created_at, updated_at, diretor_id) FROM stdin;
5	Instituto Monitor	São José Do Rio Preto	elivaldo.moraes@institutomonitor.com.br	sp	Rua Santo Agostinho, 312 - Vila Nossa Senhora Da Paz	1	20200504 19:24:20	20200504 19:24:20	2
6	Escola de Educação Infantil Aprendiz	São José Do Rio Preto	eeiaprendiz@hotmail.com	sp	Avenida Feliciano Salles Cunha, 601 - Jardim Novo Aeroporto	1	20200505 12:55:43	20200505 12:55:43	2
7	Escola de Educação Infantil Colibri	São José Do Rio Preto	colibri.escola@yahoo.com.br	sp	Avenida Francisco Prestes Maia, 1333 - Jardim Primavera	1	20200505 12:56:34	20200505 12:56:34	2
\.


--
-- Data for Name: permissoes; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.permissoes (id, funcionalidade, permissoes, ativo, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: professor_disciplina; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.professor_disciplina (id, ativo, created_at, updated_at, disciplina_id, professor_id, turma_id) FROM stdin;
\.


--
-- Data for Name: professores; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.professores (id, nome, email, fotosurls, ativo, created_at, updated_at, documento, documento_id) FROM stdin;
\.


--
-- Data for Name: responsaveis; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.responsaveis (id, nome, email, endereco, telefone, ativo, created_at, updated_at, documento, documento_id) FROM stdin;
\.


--
-- Data for Name: tokens; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.tokens (id, token, refresh_token, expired_at, usuario_id) FROM stdin;
1	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMDI6NDY6NDcifQ.j6PN4u1a8t2gTPvyU7DS0eENLtaiWQiSUPTbGLYNrk4	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViNzk1NDg1NjE2ZiJ9.8lLGark5WwxaejMEKtbJiWQdorc_Urk0s5DcynfdG2w	2020-05-12 02:46:47	19
2	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMDI6NDk6MDcifQ.P3AYFuuaghC5AFpd8l2oZYBG6NQ-AYqkrjQuSbU5UQw	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViNzk1ZDQzZDg2YiJ9.HJ7-TV_Xnb-lOlqP-fCwIwLfCOVJT7t7Z0nc9-SfcrE	2020-05-12 02:49:07	19
3	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMDM6MDI6MjIifQ.t-vFpfutKbOWkBXMNSCn3OBULV2t22qxwyWVK7pHFYg	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViNzk4ZWViMDQ2YiJ9.Z_x_qV53_gxvT9eMpvTkeTx30uz0sRXpGYvE9MUiDkY	2020-05-12 03:02:22	19
4	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMDM6MDI6MzAifQ.16pUjdY-7Fmzw9crsEL1IXIt3GZrClJ_Rnp9zeVts8U	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViNzk4ZjcyZDk2YSJ9.kELGOqdCBRHUpejOcVMLgTUgBZNtebuMRAOCKa1VQ_Y	2020-05-12 03:02:30	19
5	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMDM6MDY6NTAifQ.PPkBpjCRnInOm8Tel86skWpuByMkO3i5I41IYpsU_Pc	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViNzk5ZmI0NTgxYSJ9.78cV6bBpd-oLOQkjWRIddCQkcNNn8rsKK_H6E-1xqCs	2020-05-12 03:06:50	19
6	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMDM6MDg6MTMifQ.mZnBks7r2kkkr2ZUMIkkROjkjrQIw_TOYVGE2ncgYR4	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViNzlhNGRiY2IwYSJ9.1avw0iIFB8hbY9sLpz6ZO-GhuUyPJX6uB9ZDJioelyo	2020-05-12 03:08:13	19
7	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMDM6MDk6MTgifQ.4QFQGsVXOQ58m_17vNs5ybwXTMDoUI4gILcFDlmdaAg	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViNzlhOGYyYWVkNiJ9.KLk9EJL89PDS6Q_zstoY7t1C62uvVa41W_4as_ZTZ7I	2020-05-12 03:09:18	19
8	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMTk6MTg6MTkifQ.NqTznWu1wyn1-VdAab69H_rp7qivz-1oKGC3ESSO1qI	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViODdkYWJkMDA0OCJ9.G8GtHs99mEEjFjs1QEnJBVH_yPpcHc0-lYIo1BDiII8	2020-05-12 19:18:19	19
9	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMTk6MTg6NTAifQ.oZ6H9ke7wlEwAxHPwq0gX9XC_3_r4rjX2a_6CtFXqZU	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViODdkY2IwYzYwMCJ9.-W8veuGdd6IOYzBqTZOgQP0yP0uXOT3iXMOUjqJ41Ls	2020-05-12 19:18:50	19
10	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMTk6MjM6MzkifQ.S57rR2ge5dUv33uJdwhbMAG7pYsdNaDJdGo-K-KuIrk	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViODdlZWJhODQ0NSJ9.koQoei8-WA5H4PYfYKeJSSc46zYWGw6sdFnH7vup8EM	2020-05-12 19:23:39	19
11	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMTk6Mzg6MzYifQ.nL9TveYYdLLHZ3boi1_swh46nVssqUBm6ejZ0OzZCNE	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViODgyNmM2M2E5MCJ9.8VH7Y0NUiKTpDt5lOJ3gS4JQOcIPv0CHd3ikMHfhC70	2020-05-12 19:38:36	19
12	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMTk6NDg6MTAifQ.j9yOcg5XgvLXB2Z7Wc7SMjULNss4eGyVswdA0y-wIEY	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViODg0YWE5NDIwYyJ9.Rx2SwqfFtJ7JsY8LfZ2Jm8DuuSL0StCJLmA6hskogTg	2020-05-12 19:48:10	19
13	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMTIgMTk6NDk6MzMifQ._WXV0QTgs5_5n5cH7zFfF6bwA8AVLyrGZOclHpH2dlE	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWViODg0ZmRhMGZmMyJ9.1Ie-nDZWefllowV5CpHliLsOZzhAEAG_qFsj3LL2irs	2020-05-12 19:49:33	19
14	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE5LCJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwibmFtZSI6ImFkbWluIiwiZXhwaXJlZF9hdCI6IjIwMjAtMDUtMjEgMTc6NTU6MDcifQ.jbfmTGNeSBqoTW4Q7SDn6C0tpmazZ8uYqAo5BtFqja0	eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImZpbGlwZW1hY2hhZG9AZW1haWwuY29tIiwicmFuZG9tIjoiNWVjNDQ3YWJlMDkyZiJ9.sMY78-eM7TYJ0ZmmdWmK9FutXFgdWpiMgVRP3yfTdSo	2020-05-21 17:55:07	19
\.


--
-- Data for Name: turmas; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.turmas (id, nome, ativo, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.usuarios (id, usuario, email, senha, ativo, created_at, updated_at, grupo_id) FROM stdin;
19	admin	filipemachado@email.com	$argon2i$v=19$m=65536,t=4,p=1$YVB4Yi53Z091YWxpWlRqdw$CsZuzMeIvJOEb2amYY27QgQa2tzC3Sw7ZnAR26uzqPA	1	20200504 14:31:51	20200504 14:31:51	1
\.


--
-- Name: aluno_disciplina_turma_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.aluno_disciplina_turma_id_seq', 1, false);


--
-- Name: aluno_responsavel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.aluno_responsavel_id_seq', 1, false);


--
-- Name: alunos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.alunos_id_seq', 1, false);


--
-- Name: diretores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.diretores_id_seq', 2, true);


--
-- Name: disciplinas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.disciplinas_id_seq', 1, false);


--
-- Name: documentos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.documentos_id_seq', 1, true);


--
-- Name: grupos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.grupos_id_seq', 5, true);


--
-- Name: instituicoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.instituicoes_id_seq', 7, true);


--
-- Name: permissoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.permissoes_id_seq', 1, false);


--
-- Name: professor_disciplina_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.professor_disciplina_id_seq', 1, false);


--
-- Name: professores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.professores_id_seq', 1, false);


--
-- Name: responsaveis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.responsaveis_id_seq', 1, false);


--
-- Name: tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.tokens_id_seq', 14, true);


--
-- Name: turmas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.turmas_id_seq', 1, false);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 19, true);


--
-- Name: aluno_disciplina_turma aluno_disciplina_turma_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_disciplina_turma
    ADD CONSTRAINT aluno_disciplina_turma_id_key UNIQUE (id);


--
-- Name: aluno_responsavel aluno_responsavel_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_responsavel
    ADD CONSTRAINT aluno_responsavel_id_key UNIQUE (id);


--
-- Name: alunos alunos_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.alunos
    ADD CONSTRAINT alunos_id_key UNIQUE (id);


--
-- Name: diretores diretores_email_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.diretores
    ADD CONSTRAINT diretores_email_key UNIQUE (email);


--
-- Name: diretores diretores_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.diretores
    ADD CONSTRAINT diretores_id_key UNIQUE (id);


--
-- Name: disciplinas disciplinas_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.disciplinas
    ADD CONSTRAINT disciplinas_id_key UNIQUE (id);


--
-- Name: documentos documentos_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.documentos
    ADD CONSTRAINT documentos_id_key UNIQUE (id);


--
-- Name: grupos grupos_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grupos
    ADD CONSTRAINT grupos_id_key UNIQUE (id);


--
-- Name: instituicoes instituicoes_email_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.instituicoes
    ADD CONSTRAINT instituicoes_email_key UNIQUE (email);


--
-- Name: instituicoes instituicoes_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.instituicoes
    ADD CONSTRAINT instituicoes_id_key UNIQUE (id);


--
-- Name: permissoes permissoes_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.permissoes
    ADD CONSTRAINT permissoes_id_key UNIQUE (id);


--
-- Name: professor_disciplina professor_disciplina_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professor_disciplina
    ADD CONSTRAINT professor_disciplina_id_key UNIQUE (id);


--
-- Name: professores professores_email_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professores
    ADD CONSTRAINT professores_email_key UNIQUE (email);


--
-- Name: professores professores_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professores
    ADD CONSTRAINT professores_id_key UNIQUE (id);


--
-- Name: responsaveis responsaveis_email_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.responsaveis
    ADD CONSTRAINT responsaveis_email_key UNIQUE (email);


--
-- Name: responsaveis responsaveis_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.responsaveis
    ADD CONSTRAINT responsaveis_id_key UNIQUE (id);


--
-- Name: tokens tokens_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.tokens
    ADD CONSTRAINT tokens_id_key UNIQUE (id);


--
-- Name: turmas turmas_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.turmas
    ADD CONSTRAINT turmas_id_key UNIQUE (id);


--
-- Name: usuarios usuarios_email_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_email_key UNIQUE (email);


--
-- Name: usuarios usuarios_id_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_id_key UNIQUE (id);


--
-- Name: aluno_disciplina_turma aluno_disciplina_turma_aluno_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_disciplina_turma
    ADD CONSTRAINT aluno_disciplina_turma_aluno_id_fkey FOREIGN KEY (aluno_id) REFERENCES public.alunos(id);


--
-- Name: aluno_disciplina_turma aluno_disciplina_turma_disciplina_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_disciplina_turma
    ADD CONSTRAINT aluno_disciplina_turma_disciplina_id_fkey FOREIGN KEY (disciplina_id) REFERENCES public.disciplinas(id);


--
-- Name: aluno_disciplina_turma aluno_disciplina_turma_turma_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_disciplina_turma
    ADD CONSTRAINT aluno_disciplina_turma_turma_id_fkey FOREIGN KEY (turma_id) REFERENCES public.turmas(id);


--
-- Name: aluno_responsavel aluno_responsavel_aluno_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_responsavel
    ADD CONSTRAINT aluno_responsavel_aluno_id_fkey FOREIGN KEY (aluno_id) REFERENCES public.alunos(id);


--
-- Name: aluno_responsavel aluno_responsavel_responsavel_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.aluno_responsavel
    ADD CONSTRAINT aluno_responsavel_responsavel_id_fkey FOREIGN KEY (responsavel_id) REFERENCES public.responsaveis(id);


--
-- Name: alunos alunos_documento_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.alunos
    ADD CONSTRAINT alunos_documento_id_fkey FOREIGN KEY (documento_id) REFERENCES public.documentos(id);


--
-- Name: alunos alunos_responsavel_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.alunos
    ADD CONSTRAINT alunos_responsavel_id_fkey FOREIGN KEY (responsavel_id) REFERENCES public.responsaveis(id);


--
-- Name: diretores diretores_documento_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.diretores
    ADD CONSTRAINT diretores_documento_id_fkey FOREIGN KEY (documento_id) REFERENCES public.documentos(id);


--
-- Name: instituicoes instituicoes_diretor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.instituicoes
    ADD CONSTRAINT instituicoes_diretor_id_fkey FOREIGN KEY (diretor_id) REFERENCES public.diretores(id);


--
-- Name: professor_disciplina professor_disciplina_disciplina_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professor_disciplina
    ADD CONSTRAINT professor_disciplina_disciplina_id_fkey FOREIGN KEY (disciplina_id) REFERENCES public.disciplinas(id);


--
-- Name: professor_disciplina professor_disciplina_professor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professor_disciplina
    ADD CONSTRAINT professor_disciplina_professor_id_fkey FOREIGN KEY (professor_id) REFERENCES public.professores(id);


--
-- Name: professor_disciplina professor_disciplina_turma_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professor_disciplina
    ADD CONSTRAINT professor_disciplina_turma_id_fkey FOREIGN KEY (turma_id) REFERENCES public.turmas(id);


--
-- Name: professores professores_documento_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.professores
    ADD CONSTRAINT professores_documento_id_fkey FOREIGN KEY (documento_id) REFERENCES public.documentos(id);


--
-- Name: responsaveis responsaveis_documento_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.responsaveis
    ADD CONSTRAINT responsaveis_documento_id_fkey FOREIGN KEY (documento_id) REFERENCES public.documentos(id);


--
-- Name: tokens tokens_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.tokens
    ADD CONSTRAINT tokens_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id);


--
-- Name: usuarios usuarios_grupo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_grupo_id_fkey FOREIGN KEY (grupo_id) REFERENCES public.grupos(id);


--
-- PostgreSQL database dump complete
--

--
-- Database "postgres" dump
--

\connect postgres

--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2 (Debian 12.2-2.pgdg100+1)
-- Dumped by pg_dump version 12.2 (Debian 12.2-2.pgdg100+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database cluster dump complete
--

