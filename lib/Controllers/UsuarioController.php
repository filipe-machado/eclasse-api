<?php
/*
 * Usuario
 */

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\EclasseBD\UsuarioDAO;
use App\Exception\EclasseException;
use App\Models\MySQL\EclasseBD\UsuarioModel;

use const src\{
  DEVELOP,
  ERROR0001,
  ERROR0002,
  ERROR0003
};

/*
 * Usuario
 */

final class UsuarioController
{
  public function getUsuarios(Request $request, Response $response, array $args): Response
  {
    $usuarioDAO = new UsuarioDAO();
    $usuarios = '';

    if (count($args) == 0) {
      $usuarios = $usuarioDAO->getAllUsuarios();
    } else if (is_numeric($args['usuario'])) {
      $usuarios = $usuarioDAO->getUsuario($args['usuario']);
    } else if (!is_numeric($args['usuario'])) {
      $usuarios = $usuarioDAO->find('usuario', $args['usuario']);
    }
    if (count($usuarios) == 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'nenhum usuário encontrado'
      ]);
      return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }


    $response = $response->withJson($usuarios);
    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);
    return $response;
  }

  public function setUsuarios(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $usuarioDAO = new UsuarioDAO();
    $nome = $usuarioDAO->find('email', $data['email']);

    if (count($nome) > 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'usuário já cadastrado com esse email'
      ]);
      return $response->withHeader('Content-Type', 'application/json')->withStatus(409);
    }

    $usuario = new UsuarioModel();
    $usuario->setUsuario($data['usuario']);
    $usuario->setEmail($data['email']);
    $usuario->setSenha(password_hash($data['senha'], PASSWORD_ARGON2I));
    $usuario->setAtivo($data['ativo'] ?? 1);
    $usuario->setCriadoEm(date('Ymd H:i:s'));
    $usuario->setAtualizadoEm(date('Ymd H:i:s'));
    $usuario->setGrupoId($data['grupo']);

    $usuarioDAO->insertUsuario($usuario);

    $response = $response->withJson([
      'success' => true,
      'message' => 'usuário cadastrado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
  }

  public function putUsuarios(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $usuarioDAO = new UsuarioDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR0001['id'], ERROR0001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($usuarioDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR0003['id'], ERROR0003['value']);
      return $result->test($request, $response, $args);
    }

    $usuario = new UsuarioModel();
    $usuario->setUsuario($data['usuario']);
    $usuario->setEmail($data['email']);
    $usuario->setSenha(password_hash($data['senha'], PASSWORD_ARGON2I));
    $usuario->setAtivo($data['ativo'] ?? 1);
    $usuario->setAtualizadoEm(date('Ymd H:i:s'));
    $usuario->setGrupoId($data['grupo']);

    $usuarioDAO->putUsuario($usuario, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'usuário atualizado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function patchUsuarios(Request $request, Response $response, array $args): Response
  {
    $data = $request->getParsedBody();
    $usuarioDAO = new UsuarioDAO();
    if (!isset($data['id'])) {
      $result = new ExceptionController(new EclasseException(''), 'o id não foi informado', DEVELOP['email'], 400, ERROR0001['id'], ERROR0001['value']);
      return $result->test($request, $response, $args);
    }
    if (count($usuarioDAO->find('id', $data['id'])) === 0) {
      $result = new ExceptionController(new EclasseException(''), '', DEVELOP['email'], 400, ERROR0003['id'], ERROR0003['value']);
      return $result->test($request, $response, $args);
    }

    $usuario = new UsuarioModel();
    /* $data['usuario'] && $usuario->setUsuario($data['usuario']);
        $data['email'] && $usuario->setEmail($data['email']);
        $data['ativo'] && $usuario->setAtivo($data['ativo'] ?? 1);
        $data['created_at'] && $usuario->setCriadoEm(date('Ymd H:i:s'));
        $data['grupo'] && $usuario->setGrupoId($data['grupo']); */
    isset($data['senha']) && $usuario->setSenha(password_hash($data['senha'], PASSWORD_ARGON2I));
    $usuario->setAtualizadoEm(date('Ymd H:i:s'));

    $usuarioDAO->patchUsuario($usuario, $data, $data['id']);

    $response = $response->withJson([
      'success' => true,
      'message' => 'usuário atualizado com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }

  public function deleteUsuarios(Request $request, Response $response, array $args): Response
  {
    $usuarioDAO = new UsuarioDAO();
    if (count($usuarioDAO->find('id', $args['usuario'])) === 0) {
      $response = $response->withJson([
        'success' => false,
        'message' => 'usuário não encontrado'
      ]);

      return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $usuarioDAO->deleteUsuario($args['usuario']);
    $response = $response->withJson([
      'success' => true,
      'message' => 'usuário removido com sucesso'
    ]);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(204);
  }
}
