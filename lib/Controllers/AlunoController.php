<?php
/*
 * Aluno
 */
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\EclasseBD\AlunoDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\AlunoModel;

use const src\{
    DEVELOP,
    ERROR4001,
    ERROR4002,
    ERROR4003
};

/*
 * Aluno
 */
final class AlunoController {
    public function getAlunos(Request $request, Response $response, array $args): Response
    {
        $alunoDAO = new AlunoDAO();
        $alunos = '';
        if ($args == null) {
            $alunos = $alunoDAO->find('', '');
        } else if (is_numeric($args['aluno'])) {
            $alunos = $alunoDAO->find('id', $args['aluno']);
        } else if (!is_numeric($args['aluno'])) {
            $alunos = $alunoDAO->find('nome', $args['aluno']);
        }
        if (count($alunos) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'nenhum aluno cadastrado na base de dados'
            ]);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        $response = $response->withJson($alunos);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function setAlunos(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $alunoDAO = new AlunoDAO();
        $documento = $alunoDAO->find('documento', $data['documento']);
        if (count($documento) > 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'um aluno já possui cadastro com este documento'
            ]);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
        }

        $aluno = new AlunoModel();
        $aluno->setNome($data['nome']);
        $aluno->setDataMatricula($data['data_matricula'] ?? date('Ymd'));
        $aluno->setDataNasc($data['data_nasc']);
        $aluno->setDocumento($data['documento']);
        $aluno->setDocumentoId($data['documento_id'] ?? 1);
        $aluno->setEstudando($data['estudando'] ?? 1);
        $aluno->setFinalizado($data['finalizado'] ?? 0);
        $aluno->setFotoUrls($data['fotosUrls'] ?? '');
        $aluno->setTransferido($data['transferido'] ?? 0);
        $aluno->setResponsavelId($data['responsavel']);
        $aluno->setAtivo($data['ativo'] ?? 1);
        $aluno->setTipoMatricula($data['tipo_matricula'] ?? 'matricula');
        $aluno->setCreatedAt(date('Ymd H:i:s'));
        $aluno->setUpdatedAt(date('Ymd H:i:s'));
        $alunoDAO->insertAluno($aluno);

        $response = $response->withJson([
            'success' => true,
            'message' => 'aluno cadastrado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function putAlunos(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $alunoDAO = new AlunoDAO();
        if (!isset($data['id'])) {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR4001['id'], ERROR4001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($alunoDAO->find('id', $data['id'])) === 0) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR4002['id'], ERROR4002['value']);
            return $result->test($request, $response, $args);
        }

        $aluno = new AlunoModel();
        $aluno->setNome($data['nome']);
        $aluno->setDataMatricula($data['data_matricula'] ?? date('Ymd'));
        $aluno->setDataNasc($data['data_nasc']);
        $aluno->setDocumento($data['documento']);
        $aluno->setDocumentoId($data['documento_id'] ?? 1);
        $aluno->setEstudando($data['estudando'] ?? 1);
        $aluno->setFinalizado($data['finalizado'] ?? 0);
        $aluno->setFotoUrls($data['fotosUrls'] ?? '');
        $aluno->setTransferido($data['transferido' ?? 0]);
        $aluno->setAtivo($data['ativo'] ?? 1);
        $aluno->setResponsavelId($data['responsavel'] ?? 1);
        $aluno->setTipoMatricula($data['tipo_matricula'] ?? 'matricula');
        $aluno->setUpdatedAt(date('Ymd H:i:s'));

        $alunoDAO->putAluno($aluno, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'aluno atualizado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }

    public function patchAlunos(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $alunoDAO = new AlunoDAO();
        if (!isset($data['id'])) {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR4001['id'], ERROR4001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($alunoDAO->find('id', $data['id'])) === 0) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR4002['id'], ERROR4002['value']);
            return $result->test($request, $response, $args);
        }

        $aluno = new AlunoModel();
        /* isset($data['nome']) && $aluno->setNome($data['nome']);
        isset($data['data_matricula']) && $aluno->setDataMatricula($data['data_matricula'] ?? date('Ymd'));
        isset($data['data_nasc']) && $aluno->setDataNasc($data['data_nasc']);
        isset($data['documento']) && $aluno->setDocumento($data['documento']);
        isset($data['documento_id']) && $aluno->setDocumentoId($data['documento_id'] ?? 1);
        isset($data['estudando']) && $aluno->setEstudando($data['estudando'] ?? 1);
        isset($data['finalizado']) && $aluno->setFinalizado($data['finalizado'] ?? 0);
        isset($data['fotosUrls']) && $aluno->setFotoUrls($data['fotosUrls'] ?? '');
        isset($data['transferido']) && $aluno->setTransferido($data['transferido' ?? 0]);
        isset($data['ativo']) && $aluno->setAtivo($data['ativo'] ?? 1);
        isset($data['tipo_matricula']) && $aluno->setTipoMatricula($data['tipo_matricula'] ?? 'matricula'); */
        $aluno->setUpdatedAt(date('Ymd H:i:s'));

        $alunoDAO->patchAluno($aluno, $data, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'aluno atualizado com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }

    public function deleteAlunos(Request $request, Response $response, array $args): Response
    {
        if ($args['aluno'] === null) {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR4003['id'], ERROR4003['value']);
            return $result->test($request, $response, $args);
        }
        $alunoDAO = new AlunoDAO();
        if (count($alunoDAO->find('id', $args['aluno'])) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'aluno não encontrado'
            ]);

            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $alunoDAO->deleteAluno($args['aluno']);
        $response = $response->withJson([
            'success' => true,
            'message' => 'aluno removido com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }
}
