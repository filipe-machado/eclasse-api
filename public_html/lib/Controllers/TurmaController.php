<?php
/*
 * Turma
 */

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\EclasseBD\TurmaDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\TurmaModel;

use const src\{
  DEVELOP,
  ERROR5001,
  ERROR5002,
  ERROR5003
};

/*
 * Turma
 */

final class TurmaController
{
  public function getTurmas(Request $request, Response $response, array $args): Response
  {
    $turmaDAO = new TurmaDAO();
    $turmas = '';
    if ($args == null) {
      $turmas = $turmaDAO->find('', '');
    } else if (is_numeric($args['turma'])) {
      $turmas = $turmaDAO->find('id', $args['turma']);
    } else if (!is_numeric($args['turma'])) {
      $turmas = $turmaDAO->find('nome', $args['turma']);
    }
    if (count($turmas) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'nenhuma turma cadastrada na base de dados'
      ]);
      return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    $response = $response->withJson($turmas);
    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);
  }

  public function setTurmas(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $turmaDAO = new TurmaDAO();
    $nome = $turmaDAO->find('nome', $data['nome']);
    if (count($nome) > 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'turma já possui cadastro'
      ]);

      return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
    }
    $turma = new TurmaModel();
    $turma->setNome($data['nome']);
    $turma->setAtivo($data['ativo'] ?? 1);
    $turma->setCreatedAt(date('Ymd H:i:s'));
    $turma->setUpdatedAt(date('Ymd H:i:s'));
    $turmaDAO->insertTurma($turma);

    $response = $response->withJson([
      'success' => true,
      'message' => 'turma cadastrada com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
  }

  public function putTurmas(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $turmaDAO = new TurmaDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR5001['id'], ERROR5001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($turmaDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR5002['id'], ERROR5002['value']);
      return $result->test($request, $response, $args);
    }

    $turma = new TurmaModel();
    $turma->setNome($data['nome']);
    $turma->setAtivo($data['ativo']);
    $turma->setUpdatedAt(date('Ymd H:i:s'));

    $turmaDAO->putTurma($turma, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'turma atualizada com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function patchTurmas(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $turmaDAO = new TurmaDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR5001['id'], ERROR5001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($turmaDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR5002['id'], ERROR5002['value']);
      return $result->test($request, $response, $args);
    }

    $turma = new TurmaModel();
    /* $data['nome'] && $turma->setNome($data['nome']);
        $data['ativo'] && $turma->setAtivo($data['ativo']);
        $data['created_at'] && $turma->setCreatedAt($data['created_at']); */
    $turma->setUpdatedAt(date('Ymd H:i:s'));

    $turmaDAO->patchTurma($turma, $data, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'turma atualizada com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function deleteTurmas(Request $request, Response $response, array $args): Response
  {
    if (count($args) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR5003['id'], ERROR5003['value']);
      return $result->test($request, $response, $args);
    }
    $turmaDAO = new TurmaDAO();
    if (count($turmaDAO->find('id', $args['turma'])) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'turma não encontrada'
      ]);

      return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $turmaDAO->deleteTurma($args['turma']);
    $response = $response->withJson([
      'success' => true,
      'message' => 'turma removida com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }
}
