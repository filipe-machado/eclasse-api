<?php
/*
 * Instituicao
 */
namespace App\Controllers;

use App\DAO\MySQL\EclasseBD\DiretorDAO;
use App\DAO\MySQL\EclasseBD\InstituicaoDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\InstituicaoModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use const src\{
    DEVELOP,
    ERROR2001,
    ERROR2002
};

/*
 * Instituicao
 */
final class InstituicaoController {

    public function getInstituicoes(Request $request, Response $response, array $args): Response
    {
        $instituicaoDAO = new InstituicaoDAO();
        $instituicoes = '';
        $instituicao = strtolower($args['instituicao']);
        if ($args == null) {
            $instituicoes = $instituicaoDAO->find('', '');
        } else if (is_numeric($instituicao)) {
            $instituicoes = $instituicaoDAO->find('id', $instituicao);
        } else if (!is_numeric($instituicao)) {
            $instituicoes = $instituicaoDAO->find('nome',$instituicao);
        }

        if (count($instituicoes) === 0) {
            $result = new ExceptionController(new EclasseException(''), "", DEVELOP['email'], 400, ERROR2002['id'], ERROR2002['value']);
            return $result->test($request, $response, $args);
        }
        $response = $response->withJson($instituicoes);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getInstituicoesPorCidade(Request $request, Response $response, array $args): Response
    {
        $instituicaoDAO = new InstituicaoDAO();
        $instituicoes = '';
        if (strlen(is_numeric($args['cidade'])))
        {
            $result = new ExceptionController(new EclasseException(''), "", DEVELOP['email'], 400, ERROR2002['id'], ERROR2002['value']);
            return $result->test($request, $response, $args);

        }
        if (strlen($args['cidade']) < 3)
        {
            $result = new ExceptionController(new EclasseException(''), "", DEVELOP['email'], 400, ERROR2002['id'], ERROR2002['value']);
            return $result->test($request, $response, $args);
        }
        else if (!is_numeric($args['cidade']))
        {
            $instituicoes = $instituicaoDAO->find('cidade', $args['cidade']);
        }
        if (count(($instituicoes)) == 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => "nenhuma instituição encontrada em '{$args['cidade']}'"
            ]);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $response = $response->withJson($instituicoes);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getInstituicoesPorUF(Request $request, Response $response, array $args): Response
    {
        $instituicaoDAO = new InstituicaoDAO();
        $instituicoes = '';
        if (is_numeric($args['uf']))
        {
            $result = new ExceptionController(new EclasseException(''), "não é permitido números", 400, '002', 'informe uma sigla de UF válida');
            return $result->test($request, $response, $args);
        }

        if (strlen($args['uf']) !== 2)
        {
            $result = new ExceptionController(new EclasseException(''), "necessário 2 caracteres", 400, '002', 'informe uma sigla de UF válida');
            return $result->test($request, $response, $args);
        }

        else if (!is_numeric($args['uf'])) {
            $instituicoes = $instituicaoDAO->find('uf', $args['uf']);
        }

        if (count($instituicoes) === 0) {
            $response = $response->withJson([
                'success' => true,
                'message' => "nenhuma instituição cadastrada nessa UF"
            ]);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $response = $response->withJson($instituicoes);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function setInstituicoes(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $instituicaoDAO = new InstituicaoDAO();
        $diretorDAO = new DiretorDAO();
        $nome = $instituicaoDAO->find('nome', $data['nome']);
        $cidade = $instituicaoDAO->find('cidade', $data['cidade']);
        $diretor = isset($data['diretor']) ? $diretorDAO->find('id', $data['diretor']): '';
        if(count($nome) && count($cidade) > 0)
        {
            $response = $response->withJson([
                'success' => false,
                'message' => 'instituição já possui cadastro'
            ]);

            return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
        }
        if ($diretor !== '' && count($diretor) == 0) {
            $result = new ExceptionController(new EclasseException(''), 'informe este erro ao desenvovedor', 400, '101', 'diretor informado não existe');
            return $result->test($request, $response, $args);
        }
        $instituicao = new InstituicaoModel();
        $instituicao->setNome($data['nome']);
        $instituicao->setEmail($data['email']);
        $instituicao->setEndereco($data['endereco']);
        $instituicao->setCidade($data['cidade']);
        $instituicao->setUf($data['uf']);
        $instituicao->setDiretorId($data['diretor'] ?? 2);
        $instituicao->setAtivo($data['ativo'] ?? 1);
        $instituicao->setCriadoEm(date('Ymd H:i:s'));
        $instituicao->setAtualizadoEm(date('Ymd H:i:s'));
        $instituicaoDAO->insertInstituicao($instituicao);

        $response = $response->withJson([
            'success' => true,
            'message' => 'instituicao cadastrada com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function putInstituicoes(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $instituicaoDAO = new InstituicaoDAO();
        if (!isset($data['id']))
        {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR2001['id'], ERROR2001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($instituicaoDAO->find('id', $data['id'])) === 0)
        {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR2002['id'], ERROR2002['value']);
            return $result->test($request, $response, $args);
        }

        $instituicao = new InstituicaoModel();
        $instituicao->setNome($data['nome']);
        $instituicao->setEmail($data['email']);
        $instituicao->setEndereco($data['endereco']);
        $instituicao->setCidade($data['cidade']);
        $instituicao->setUf($data['uf']);
        $instituicao->setDiretorId($data['diretor_id']);
        $instituicao->setAtivo($data['ativo']);
        $instituicao->setAtualizadoEm(date('Ymd H:i:s'));

        $instituicaoDAO->putInstituicao($instituicao, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'instituicao atualizada com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }

    public function patchInstituicoes(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $instituicaoDAO = new InstituicaoDAO();
        if (!isset($data['id']))
        {
            $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR2001['id'], ERROR2001['value']);
            return $result->test($request, $response, $args);
        }
        if (count($instituicaoDAO->find('id', $data['id'])) === 0)
        {
            $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR2002['id'], ERROR2002['value']);
            return $result->test($request, $response, $args);
        }

        $instituicao = new InstituicaoModel();
        /* isset($data['nome']) && $instituicao->setNome($data['nome']);
        isset($data['endereco']) && $instituicao->setEndereco($data['endereco']);
        isset($data['cidade']) && $instituicao->setCidade($data['cidade']);
        isset($data['uf']) && $instituicao->setUf($data['uf']);
        isset($data['diretor_id']) && $instituicao->setDiretorId($data['diretor_id']);
        isset($data['ativo']) && $instituicao->setAtivo($data['ativo']);
        isset($data['created_at']) && $instituicao->setCriadoEm($data['created_at']); */
        $instituicao->setAtualizadoEm(date('Ymd H:i:s'));

        $instituicaoDAO->patchInstituicao($instituicao, $data, $data['id']);

        $response = $response->withJson([
            'success' => true,
            'message' => 'instituicao atualizada com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }

    public function deleteInstituicoes(Request $request, Response $response, array $args): Response
    {
        $instituicaoDAO = new InstituicaoDAO();
        if (count($instituicaoDAO->find('id', $args['instituicao'])) === 0) {
            $response = $response->withJson([
                'success' => false,
                'message' => 'instituicao não encontrada'
            ]);

            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $instituicaoDAO->deleteInstituicao($args['instituicao']);
        $response = $response->withJson([
            'success' => true,
            'message' => 'instituicao removida com sucesso'
        ]);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
    }
}
