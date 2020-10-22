<?php
/*
 * Professor
 */

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\EclasseBD\ProfessorDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\ProfessorModel;

use const src\{
  ERROR3001,
  ERROR3002,
  DEVELOP
};

/*
 * Professor
 */

final class ProfessorController
{
  public function getProfessores(Request $request, Response $response, array $args): Response
  {
    $professorDAO = new ProfessorDAO();
    $professor = '';
    if ($args == null) {
      $professor = $professorDAO->find('', '');
    } else if (is_numeric($args['professor'])) {
      $professor = $professorDAO->find('id', $args['professor']);
    } else if (!is_numeric($args['professor'])) {
      $professor = $professorDAO->find('nome', $args['professor']);
    }
    if (count($professor) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'nenhum professor cadastrado na base de dados'
      ]);
      return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    $response = $response->withJson($professor);
    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);
  }

  public function setProfessores(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $professorDAO = new ProfessorDAO();
    $nome = $professorDAO->find('nome', $data['nome']);
    $documento = $professorDAO->find('documento', $data['documento']);
    if (count($nome) && count($documento) > 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'professor já cadastrado'
      ]);

      return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
    }

    $professor = new ProfessorModel();
    $professor->setNome($data['nome']);
    $professor->setDocumento($data['documento']);
    $professor->setDocumentoId($data['documento_id']);
    $professor->setFotoUrls($data['fotosUrls']);
    $professor->setAtivo($data['ativo'] ?? 1);
    $professor->setCreatedAt(date('Ymd H:i:s'));
    $professor->setUpdatedAt(date('Ymd H:i:s'));
    $professorDAO->insertProfessor($professor);

    $response = $response->withJson([
      'success' => true,
      'message' => 'professor cadastrado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
  }

  public function putProfessores(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $professorDAO = new ProfessorDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR3001['id'], ERROR3001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($professorDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR3002['id'], ERROR3002['value']);
      return $result->test($request, $response, $args);
    }

    $professor = new ProfessorModel();
    $professor->setNome($data['nome']);
    $professor->setDocumento($data['documento']);
    $professor->setDocumentoId($data['documento_id']);
    $professor->setFotoUrls($data['fotosUrls']);
    $professor->setAtivo($data['ativo']);
    $professor->setUpdatedAt(date('Ymd H:i:s'));

    $professorDAO->putProfessor($professor, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'professor atualizado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function patchProfessores(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $professorDAO = new ProfessorDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR3001['id'], ERROR3001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($professorDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR3002['id'], ERROR3002['value']);
      return $result->test($request, $response, $args);
    }

    $professor = new ProfessorModel();
    /* isset($data['nome']) && $professor->setNome($data['nome']);
        isset($data['documento']) && $professor->setDocumento($data['documento']);
        isset($data['documento_id']) && $professor->setDocumentoId($data['documento_id']);
        isset($data['fotosUrl']) && $professor->setFotoUrls($data['fotosUrl']);
        isset($data['ativo']) && $professor->setAtivo($data['ativo']);
        isset($data['created_at']) && $professor->setCreatedAt($data['created_at']); */
    $professor->setUpdatedAt(date('Ymd H:i:s'));

    $professorDAO->patchProfessor($professor, $data, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'professor atualizado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function deleteProfessores(Request $request, Response $response, array $args): Response
  {
    $professorDAO = new ProfessorDAO();
    if (count($professorDAO->find('id', $args['professor'])) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'professor não encontrado'
      ]);

      return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $professorDAO->deleteProfessor($args['professor']);
    $response = $response->withJson([
      'success' => true,
      'message' => 'professor removido com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }
}
