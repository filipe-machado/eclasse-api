<?php
/*
 * Group
 */
namespace App\Controllers;

use App\DAO\MySQL\EclasseBD\GrupoDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\GrupoModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use const src\{
    DEVELOP,
    ERROR7001,
    ERROR7002
};

/*
 * Group
 */
final class GrupoController {
    public function getGrupos(Request $request, Response $response, array $args): Response
    {
        $grupoDAO = new GrupoDAO();
        $grupo = '';
        if ($args == null) {
            $grupo = $grupoDAO->find('', '');
        } else if (is_numeric($args['grupo'])) {
            $grupo = $grupoDAO->find('id', $args['grupo']);
        }
        if (count($grupo) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'nenhum grupo cadastrado na base de dados'
            ]);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        $response = $response->withJson($grupo);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function setGrupos(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $grupoDAO = new grupoDAO();
        $nome = $grupoDAO->find('nome', $data['nome']);
        if (count($nome) > 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'grupo com este nome já cadastrado'
            ]);

            return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
        }

        $grupo = new GrupoModel();
        $grupo->setPermissoes($data['permissoes']);
        $grupo->setNome($data['nome']);
        $grupo->setAtivo($data['ativo'] ?? 1);
        $grupo->setCreatedAt(date('Ymd H:i:s'));
        $grupo->setUpdatedAt(date('Ymd H:i:s'));
        $grupoDAO->insertGrupo($grupo);

        $response = $response->withJson([
            'success' => true,
            'message' => 'grupo cadastrado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function putGrupos(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $grupoDAO = new grupoDAO();
        if (!isset($data['id'])) {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR7001['id'], ERROR7001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($grupoDAO->find('id', $data['id'])) === 0) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR7002['id'], ERROR7002['value']);
            return $result->test($request, $response, $args);
        }

        $grupo = new grupoModel();
        $grupo->setNome($data['nome']);
        $grupo->setPermissoes($data['permissoes']);
        $grupo->setAtivo($data['ativo']);
        $grupo->setUpdatedAt(date('Ymd H:i:s'));

        $grupoDAO->putGrupo($grupo, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'grupo atualizado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }

    public function patchGrupos(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $grupoDAO = new grupoDAO();
        if (!isset($data['id'])) {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR7001['id'], ERROR7001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($grupoDAO->find('id', $data['id'])) === 0) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR7002['id'], ERROR7002['value']);
            return $result->test($request, $response, $args);
        }

        $grupo = new grupoModel();
        /* isset($data['ativo']) && $grupo->setAtivo($data['ativo']);
        isset($data['nome']) && $grupo->setNome($data['nome']);
        isset($data['permissoes']) && $grupo->setPermissoes($data['permissoes']);
        isset($data['created_at']) && $grupo->setCreatedAt($data['created_at']); */
        $grupo->setUpdatedAt(date('Ymd H:i:s'));

        $grupoDAO->patchGrupo($grupo, $data, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'grupo atualizado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }

    public function deleteGrupos(Request $request, Response $response, array $args): Response
    {
        $grupoDAO = new grupoDAO();
        if (count($grupoDAO->find('id', $args['grupo'])) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'grupo não encontrado'
            ]);

            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $grupoDAO->deleteGrupo($args['grupo']);
        $response = $response->withJson([
            'success' => true,
            'message' => 'grupo removido com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }
}
