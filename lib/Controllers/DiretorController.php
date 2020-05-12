<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\DAO\MySQL\EclasseBD\DiretorDAO as DiretorDAO;
use App\DAO\MySQL\EclasseBD\DocumentoDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\DiretorModel as DiretorModel;

use const src\DEVELOP;
use const src\ERROR1001;
use const src\ERROR1002;
use const src\ERROR8001;

final class DiretorController {
    public function getDiretores(Request $request, Response $response, array $args): Response
    {
        $diretorDAO = new DiretorDAO();
        $diretor = '';
        if ($args == null) {
            $diretor = $diretorDAO->find('', '');
        } else if (is_numeric($args['diretor'])) {
            $diretor = $diretorDAO->find('id', $args['diretor']);
        } else if (!is_numeric($args['diretor'])) {
            $diretor = $diretorDAO->find('nome', $args['diretor']);
        }
        if (count($diretor) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'nenhum diretor cadastrado na base de dados'
            ]);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        $response = $response->withJson($diretor);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getDiretoresPorDocumento(Request $request, Response $response, array $args): Response
    {
        $diretorDAO = new DiretorDAO();
        $diretor = '';
        if ($args === null) {
            $result = new ExceptionController(new EclasseException(''), "é necessário informar o número do documento", 400, ERROR8001['id'], ERROR8001['value']);
            return $result->test($request, $response, $args);
        }
        $diretor = $diretorDAO->find('documento', $args['diretor']);

        $response = $response->withJson($diretor);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function setDiretores(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $diretorDAO = new DiretorDAO();
        $documentoDAO = new DocumentoDAO();
        $documento = isset($data['documento']) ? $documentoDAO->find('id', $data['documento_id']) : '';
        $diretor = new DiretorModel();
        $diretor->setNome($data['nome']);
        $diretor->setEmail($data['email']);
        $diretor->setDocumento($data['documento'] ?? '');
        $diretor->setDocumentoId($data['documento_id'] ?? 1);
        $diretor->setAtivo($data['ativo'] ?? 1);
        $diretor->setInicio($data['inicio']);
        $diretorDAO->insertDiretor($diretor);

        $response = $response->withJson([
            'success' => true,
            'message' => 'diretor cadastrado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function putDiretores(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $diretorDAO = new DiretorDAO();
        if (!isset($data['id'])) {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR1001['id'], ERROR1001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($diretorDAO->find('id', $data['id'])) === 0) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR1002['id'], ERROR1002['value']);
            return $result->test($request, $response, $args);
        }

        $diretor = new DiretorModel();
        $diretor->setNome($data['nome']);
        $diretor->setEmail($data['email']);
        $diretor->setDocumento($data['documento']);
        $diretor->setDocumentoId($data['documento_id']);
        $diretor->setAtivo($data['ativo']);
        $diretor->setInicio($data['inicio']);
        $diretor->setAtivo($data['ativo']);
        $diretor->setUpdatedAt(date('Ymd H:i:s'));

        $diretorDAO->putDiretor($diretor, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'diretor atualizado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function patchDiretores(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $diretorDAO = new DiretorDAO();
        if (!isset($data['id'])) {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR1001['id'], ERROR1001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($diretorDAO->find('id', $data['id'])) === 0) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR1002['id'], ERROR1002['value']);
            return $result->test($request, $response, $args);
        }

        $diretor = new DiretorModel();
        /* isset($data['nome']) && $diretor->setNome($data['nome']);
        isset($data['documento']) && $diretor->setDocumento($data['documento']);
        isset($data['documento_id']) && $diretor->setDocumentoId($data['documento_id']);
        isset($data['ativo']) && $diretor->setAtivo($data['ativo']);
        isset($data['inicio']) && $diretor->setInicio($data['inicio']);
        isset($data['ativo']) && $diretor->setAtivo($data['ativo']); */
        $diretor->setUpdatedAt(date('Ymd H:i:s'));

        $diretorDAO->patchDiretor($diretor, $data, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'diretor atualizado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function deleteDiretores(Request $request, Response $response, array $args): Response
    {
        $diretorDAO = new DiretorDAO();
        if (count($diretorDAO->find('id', $args['diretor'])) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'diretor não encontrado'
            ]);

            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $diretorDAO->deleteDiretor($args['diretor']);
        $response = $response->withJson([
            'success' => true,
            'message' => 'diretor removido com sucesso'
        ]);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }
}
