<?php
/*
 * Disciplina
 */

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\EclasseBD\DisciplinaDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\DisciplinaModel;

use const src\{
  DEVELOP,
  ERROR6001,
  ERROR6002
};

/*
 * Disciplina
 */

final class DisciplinaController
{
  public function getDisciplinas(Request $request, Response $response, array $args): Response
  {
    $disciplinaDAO = new DisciplinaDAO();
    $disciplina = '';
    if ($args == null) {
      $disciplina = $disciplinaDAO->find('', '');
    } else if (is_numeric($args['disciplina'])) {
      $disciplina = $disciplinaDAO->find('id', $args['disciplina']);
    } else if (!is_numeric($args['disciplina'])) {
      $disciplina = $disciplinaDAO->find('nome', $args['disciplina']);
    }
    if (count($disciplina) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'nenhuma disciplina cadastrada na base de dados'
      ]);
      return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    $response = $response->withJson($disciplina);
    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);
  }

  public function setDisciplinas(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $disciplinaDAO = new DisciplinaDAO();
    // Não existe essa coluna, vide regra
    $nome = $disciplinaDAO->find('nome_exato', $data['nome']);
    if (count($nome) > 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'disciplina já cadastrada'
      ]);

      return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
    }

    $disciplina = new DisciplinaModel();
    $disciplina->setNome($data['nome']);
    $disciplina->setAtivo($data['ativo'] ?? 1);
    $disciplina->setCreatedAt(date('Ymd H:i:s'));
    $disciplina->setUpdatedAt(date('Ymd H:i:s'));
    $disciplinaDAO->insertDisciplina($disciplina);

    $response = $response->withJson([
      'success' => true,
      'message' => 'disciplina cadastrada com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
  }

  public function putDisciplinas(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $disciplinaDAO = new DisciplinaDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR6001['id'], ERROR6001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($disciplinaDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR6002['id'], ERROR6002['value']);
      return $result->test($request, $response, $args);
    }

    $disciplina = new DisciplinaModel();
    $disciplina->setNome($data['nome']);
    $disciplina->setAtivo($data['ativo']);
    $disciplina->setUpdatedAt(date('Ymd H:i:s'));

    $disciplinaDAO->putDisciplina($disciplina, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'disciplina atualizada com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function patchDisciplinas(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $disciplinaDAO = new DisciplinaDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR6001['id'], ERROR6001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($disciplinaDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR6002['id'], ERROR6002['value']);
      return $result->test($request, $response, $args);
    }

    $disciplina = new DisciplinaModel();
    /* isset($data['nome']) && $disciplina->setNome($data['nome']);
        isset($data['ativo']) && $disciplina->setAtivo($data['ativo']);
        isset($data['created_at']) && $disciplina->setCreatedAt($data['created_at']); */
    $disciplina->setUpdatedAt(date('Ymd H:i:s'));

    $disciplinaDAO->patchDisciplina($disciplina, $data, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'disciplina atualizada com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function deleteDisciplinas(Request $request, Response $response, array $args): Response
  {
    $disciplinaDAO = new DisciplinaDAO();
    if (count($disciplinaDAO->find('id', $args['disciplina'])) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'disciplina não encontrada'
      ]);

      return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $disciplinaDAO->deleteDisciplina($args['disciplina']);
    $response = $response->withJson([
      'success' => true,
      'message' => 'disciplina removida com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }
}
