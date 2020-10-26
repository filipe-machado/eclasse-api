<?php
/*
 * Documento
 */

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\EclasseBD\DocumentoDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\DocumentoModel;

use const src\{
  DEVELOP,
  ERROR8001,
  ERROR8002,
};

/*
 * Documento
 */

final class DocumentoController
{
  public function getDocumentos(Request $request, Response $response, array $args): Response
  {
    $documentoDAO = new DocumentoDAO();
    $documentos = '';
    if ($args == null) {
      $documentos = $documentoDAO->find('', '');
    } else if (is_numeric($args['documento'])) {
      $documentos = $documentoDAO->find('id', $args['documento']);
    } else if (!is_numeric($args['documento'])) {
      $documentos = $documentoDAO->find('nome', $args['documento']);
    }
    if (count($documentos) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'nenhum doc$documento cadastrado na base de dados'
      ]);
      return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    $response = $response->withJson($documentos);
    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);
  }

  public function setDocumentos(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $documentoDAO = new DocumentoDAO();
    $nome = $documentoDAO->find('nome', $data['nome']);
    if (count($nome) > 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'documento já possui cadastro com este nome'
      ]);
      return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
    }

    $documento = new DocumentoModel();
    $documento->setNome($data['nome']);
    $documento->setAtivo($data['ativo'] ?? 1);
    $documento->setCriadoEm(date('Ymd H:i:s'));
    $documento->setAtualizadoEm(date('Ymd H:i:s'));
    $documentoDAO->insertDocumento($documento);

    $response = $response->withJson([
      'success' => true,
      'message' => 'documento cadastrado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
  }

  public function putDocumentos(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $documentoDAO = new DocumentoDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR8001['id'], ERROR8001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($documentoDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR8002['id'], ERROR8002['value']);
      return $result->test($request, $response, $args);
    }

    $documento = new DocumentoModel();
    $documento->setNome($data['nome']);
    $documento->setAtivo($data['ativo']);
    $documento->setAtualizadoEm(date('Ymd H:i:s'));

    $documentoDAO->putDocumento($documento, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'documento atualizado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function patchDocumentos(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $documentoDAO = new DocumentoDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR8001['id'], ERROR8001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($documentoDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR8002['id'], ERROR8002['value']);
      return $result->test($request, $response, $args);
    }

    $documento = new DocumentoModel();
    /* isset($data['nome']) && $documento->setNome($data['nome']);
        isset($data['ativo']) && $documento->setAtivo($data['ativo']);
        isset($data['created_at']) && $documento->setCriadoEm($data['created_at']); */
    $documento->setAtualizadoEm(date('Ymd H:i:s'));

    $documentoDAO->patchDocumento($documento, $data, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'documento atualizado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function deleteDocumentos(Request $request, Response $response, array $args): Response
  {
    $documentoDAO = new DocumentoDAO();
    if (count($documentoDAO->find('id', $args['documento'])) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'documento não encontrado'
      ]);

      return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $documentoDAO->deleteDocumento($args['documento']);
    $response = $response->withJson([
      'success' => true,
      'message' => 'documento removido com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }
}
