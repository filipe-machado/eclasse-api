/* SELECT uuid_generate_v4(); */
/* 
INSERT INTO "eclasse_bd"."public"."grupos" (
    ativo,
    created_at,
    id,
    permissoes,
    updated_at,
    valor
  )
VALUES
  (
    1,
    '20200430 16:12:00',
    1,
    '{admin: {post: 1, put: 1, patch: 1, get: 1, delete: 1}}',
    '20200430 16:12:00',
    1
  ); */


/* INSERT INTO "eclasse_bd"."public"."usuarios" (
    ativo,
    created_at,
    email,
    grupo_id,
    senha,
    updated_at,
    usuario
  )
VALUES
  (
    1,
    '20200430',
    'email@email.com',
    1,
    '123456',
    '20200430',
    'usuario'
  ); */


/* DELETE FROM tokens; */
/* DELETE FROM usuarios; */
/* DELETE FROM grupos; */

INSERT INTO "eclasse_bd"."public"."grupos" (
    ativo,
    created_at,
    id,
    nome,
    permissoes,
    updated_at,
    valor
  )
VALUES
  (
    1,
    '20200504 09:42:00',
    1,
    'administrador',
    '["alunos", "professores", "usuários", "instituições", "documentos", "disciplinas", "diretores", "responsáveis", "turmas"]',
    '20200504 09:42:00',
    1
  );
