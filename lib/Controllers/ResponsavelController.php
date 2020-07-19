<?php
/*
 * Responsavel
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\EclasseBD\ResponsavelDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\ResponsavelModel;

use const src\{
    DEVELOP,
    ERROR9001,
    ERROR9002
};

/*
 * Responsavel
 */
final class ResponsavelController {
    public function getResponsaveis(Request $request, Response $response, array $args): Response
    {
        $responsavelDAO = new ResponsavelDAO();
        $responsaveis = '';
        if ($args == null) {
            $responsaveis = $responsavelDAO->find('', '');
        } else if (is_numeric($args['responsavel'])) {
            $responsaveis = $responsavelDAO->find('id', $args['responsavel']);
        } else if (!is_numeric($args['responsavel'])) {
            $responsaveis = $responsavelDAO->find('nome', $args['responsavel']);
        }
        if (count($responsaveis) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'nenhum responsável cadastrado na base de dados'
            ]);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        $response = $response->withJson($responsaveis);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function setResponsaveis(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $responsavelDAO = new ResponsavelDAO();
        $documento = $responsavelDAO->find('documento', $data['documento']);
        if (count($documento) > 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'um responsável já possui cadastro com este documento'
            ]);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
        }

        $responsavel = new ResponsavelModel();
        $responsavel->setAtivo($data['ativo'] ?? 1);
        $responsavel->setCreatedAt(date('Ymd H:i:s'));
        $responsavel->setDocumento($data['documento']);
        $responsavel->setDocumentoId($data['documento_id'] ?? 1);
        $responsavel->setEmail($data['email']);
        $responsavel->setEndereco($data['endereco']);
        $responsavel->setNome($data['nome']);
        $responsavel->setTelefone($data['telefone']);
        $responsavel->setUpdatedAt(date('Ymd H:i:s'));
        $responsavelDAO->insertResponsavel($responsavel);

        $response = $response->withJson([
            'success' => true,
            'message' => 'responsável cadastrado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function putResponsaveis(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $responsavelDAO = new ResponsavelDAO();
        if (!isset($data['id'])) {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR9001['id'], ERROR9001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($responsavelDAO->find('id', $data['id'])) === 0) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR9002['id'], ERROR9002['value']);
            return $result->test($request, $response, $args);
        }

        $responsavel = new ResponsavelModel();
        $responsavel->setAtivo($data['ativo'] ?? 1);
        $responsavel->setDocumento($data['documento']);
        $responsavel->setDocumentoId($data['documento_id'] ?? 1);
        $responsavel->setEmail($data['email']);
        $responsavel->setEndereco($data['endereco']);
        $responsavel->setNome($data['nome']);
        $responsavel->setTelefone($data['telefone']);
        $responsavel->setUpdatedAt(date('Ymd H:i:s'));

        $responsavelDAO->putResponsavel($responsavel, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'responsável atualizado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }

    public function patchResponsaveis(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $responsavelDAO = new ResponsavelDAO();
        if (!isset($data['id'])) {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR9001['id'], ERROR9001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($responsavelDAO->find('id', $data['id'])) === 0) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR9002['id'], ERROR9002['value']);
            return $result->test($request, $response, $args);
        }

        $responsavel = new ResponsavelModel();
        /* isset($data['ativo']) && $responsavel->setAtivo($data['ativo']);
        isset($data['documento']) && $responsavel->setDocumento($data['documento']);
        isset($data['documento_id']) && $responsavel->setDocumentoId($data['documento_id']);
        isset($data['email']) && $responsavel->setEmail($data['email']);
        isset($data['endereco']) && $responsavel->setEndereco($data['endereco']);
        isset($data['nome']) && $responsavel->setNome($data['nome']);
        isset($data['telefone']) && $responsavel->setTelefone($data['telefone']); */
        $responsavel->setUpdatedAt(date('Ymd H:i:s'));

        $responsavelDAO->patchResponsavel($responsavel, $data, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'responsável atualizado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }

    public function deleteResponsaveis(Request $request, Response $response, array $args): Response
    {
        $responsavelDAO = new ResponsavelDAO();
        if (count($responsavelDAO->find('id', $args['responsavel'])) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'responsável não encontrado'
            ]);

            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $responsavelDAO->deleteAluno($args['responsavel']);
        $response = $response->withJson([
            'success' => true,
            'message' => 'responsável removido com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }
}
