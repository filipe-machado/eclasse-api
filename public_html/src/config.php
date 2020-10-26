<?php

namespace src;

function config(): \Slim\Container
{
  $configuration = [
    'settings' => [
      'displayErrorDetails' => getenv('DISPLAY_ERRORS_DETAILS'),
    ],
  ];
  return new \Slim\Container($configuration);
}

// TODO: CONSTANTES DE DESENVOLVEDOR
const DEVELOP = ['email' => 'develop@w3i.com.br'];

// TODO: ERROS USUARIO
const ERROR0001 = ['id' => 0001, 'value' => 'usuário não informado'];
const ERROR0002 = ['id' => 0002, 'value' => 'senha não informada'];
const ERROR0003 = ['id' => 0003, 'value' => 'usuário não cadastrado'];
const ERROR0004 = ['id' => 0004, 'value' => 'senha incorreta'];
const ERROR0005 = ['id' => 0005, 'value' => 'email já cadastrado'];
const ERROR0006 = ['id' => 0005, 'value' => 'senha deve ter 6 ou mais caracteres'];
// TODO: ERROS DIRETOR
const ERROR1001 = ['id' => 1001, 'value' => 'diretor não informado'];
const ERROR1002 = ['id' => 1002, 'value' => 'diretor não encontrado'];
const ERROR1003 = ['id' => 1003, 'value' => 'diretor não informado'];
const ERROR1004 = ['id' => 1004, 'value' => 'diretor não informado'];
// TODO: ERROS INSTITUIÇÃO
const ERROR2001 = ['id' => 2001, 'value' => 'instituição não informada'];
const ERROR2002 = ['id' => 2002, 'value' => 'instituição não encontrada'];
const ERROR2003 = ['id' => 2003, 'value' => 'instituição não informada'];
const ERROR2004 = ['id' => 2004, 'value' => 'instituição não informada'];
// TODO: ERROS PROFESSOR
const ERROR3001 = ['id' => 3001, 'value' => 'professor não informado'];
const ERROR3002 = ['id' => 3002, 'value' => 'professor não encontrado'];
const ERROR3003 = ['id' => 3003, 'value' => 'professor não informado'];
const ERROR3004 = ['id' => 3004, 'value' => 'professor não informado'];
// TODO: ERROS ALUNO
const ERROR4001 = ['id' => 4001, 'value' => 'aluno não informado'];
const ERROR4002 = ['id' => 4002, 'value' => 'aluno não encontrado'];
const ERROR4003 = ['id' => 4003, 'value' => 'aluno não informado'];
const ERROR4004 = ['id' => 4004, 'value' => 'aluno não informado'];
// TODO: ERROS TURMA
const ERROR5001 = ['id' => 5001, 'value' => 'turma não informada'];
const ERROR5002 = ['id' => 5002, 'value' => 'turma não encontrada'];
const ERROR5003 = ['id' => 5003, 'value' => 'turma não informada'];
const ERROR5004 = ['id' => 5004, 'value' => 'turma não informada'];
// TODO: ERROS DISCIPLINA
const ERROR6001 = ['id' => 6001, 'value' => 'disciplina não informada'];
const ERROR6002 = ['id' => 6002, 'value' => 'disciplina não encontrada'];
const ERROR6003 = ['id' => 6003, 'value' => 'disciplina não informada'];
const ERROR6004 = ['id' => 6004, 'value' => 'disciplina não informada'];
// TODO: ERROS GRUPO
const ERROR7001 = ['id' => 7001, 'value' => 'grupo não informado'];
const ERROR7002 = ['id' => 7002, 'value' => 'grupo não encontrado'];
const ERROR7003 = ['id' => 7003, 'value' => 'grupo não informado'];
const ERROR7004 = ['id' => 7004, 'value' => 'grupo não informado'];
// TODO: ERROS DOCUMENTO
const ERROR8001 = ['id' => 8001, 'value' => 'documento não informado'];
const ERROR8002 = ['id' => 8002, 'value' => 'documento não encontrado'];
const ERROR8003 = ['id' => 8003, 'value' => 'documento não informado'];
const ERROR8004 = ['id' => 8004, 'value' => 'documento não informado'];
// TODO: ERROS RESPONSAVEL
const ERROR9001 = ['id' => 9001, 'value' => 'responsável não informado'];
const ERROR9002 = ['id' => 9002, 'value' => 'responsável não encontrado'];
const ERROR9003 = ['id' => 9003, 'value' => 'responsável não informado'];
const ERROR9004 = ['id' => 9004, 'value' => 'responsável não informado'];
