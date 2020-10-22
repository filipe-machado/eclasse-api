<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Exception\EclasseException;

final class ExceptionController
{
  private $status;
  private $code;
  private $userMessage;
  private $developMessage;
  private $email;
  private $exception;
  // TODO: atributos para completar os erros
  public function __construct(\Exception $exception, string $developMessage, string $email, int $status, string $code, string $userMessage = '')
  {
    $this->status = $status;
    $this->code = $code;
    $this->userMessage = $userMessage;
    $this->developMessage = $developMessage;
    $this->exception = $exception;
    $this->email = $email;
  }
  public function test(Request $request, Response $response, array $args): Response
  {
    try {
      throw new $this->exception($this->developMessage, 1);
      return $response->withJson(['message' => 'ok']);
    } catch (EclasseException $e) {
      return $response->withJson([
        'error' => EclasseException::class,
        'status' => $this->status,
        'code' => $this->code,
        'userMessage' => $this->userMessage,
        'developMessage' => $e->getMessage(),
        'developerEmail' => $this->email
      ], 401);
    } catch (\InvalidArgumentException $e) {
      return $response->withJson([
        'error' => \InvalidArgumentException::class,
        'status' => $this->status,
        'code' => $this->code,
        'userMessage' => $this->userMessage,
        'developMessage' => $e->getMessage(),
        'developerEmail' => $this->email
      ], 401);
    } catch (\Exception | \Throwable $e) {
      return $response->withJson([
        'error' => \Exception::class,
        'status' => $this->status,
        'code' => $this->code,
        'userMessage' => $this->userMessage,
        'developMessage' => $e->getMessage(),
        'developerEmail' => $this->email
      ], 500);
    }
  }
}
