<?php
/**
 * Eclasse
 * @version 0.0.1
 */

use function src\{
    config,
    jwtAuth
};

use App\Controllers\{
    AuthController,
    UsuarioController,
    AlunoController,
    GrupoController,
    TurmaController,
    DiretorController,
    DocumentoController,
    ProfessorController,
    DisciplinaController,
    InstituicaoController,
    ResponsavelController,
};
use App\Middlewares\JwtDateTimeMiddleware;

$app = new Slim\App(config());

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', '*')
        ->withHeader('Access-Control-Allow-Methods', '*');
});

$app->POST('/refresh-token', AuthController::class . ':refreshToken');

$app->GET('/', function() { echo 'raiz';});

$app->GET('/teste', function () {
    echo 'teste';
});
/* ->add(new JwtDateTimeMiddleware())
->add(jwtAuth()); */

$app->group('/v1', function () use ($app) {
    $app->POST('/login', AuthController::class . ':login');
    $app->POST('/register', AuthController::class . ':register');
    $app->GET('/instituicoes[/{instituicao}]', InstituicaoController::class . ':getInstituicoes');
    $app->GET('/instituicoes/cidade/{cidade}', InstituicaoController::class . ':getInstituicoesPorCidade');
    $app->GET('/instituicoes/uf/{uf}', InstituicaoController::class . ':getInstituicoesPorUF');
    $app->GET('/grupos[/{grupo}]', GrupoController::class . ':getGrupos');
});

$app->group('/v1', function() use ($app) {
    // TODO: INSTITUICOES

    $app->POST('/instituicoes', InstituicaoController::class . ':setInstituicoes');
    $app->PUT('/instituicoes', InstituicaoController::class . ':putInstituicoes');
    $app->PATCH('/instituicoes', InstituicaoController::class . ':patchInstituicoes');
    $app->DELETE('/instituicoes/{instituicao}', InstituicaoController::class . ':deleteInstituicoes');

    // TODO: DIRETORES

    $app->GET('/diretores[/{diretor}]', DiretorController::class . ':getDiretores');
    $app->GET('/diretores/documento/', DiretorController::class . ':getDiretoresPorDocumento');
    $app->GET('/diretores/documento/{diretor}', DiretorController::class . ':getDiretoresPorDocumento');
    $app->POST('/diretores', DiretorController::class . ':setDiretores');
    $app->PUT('/diretores', DiretorController::class . ':putDiretores');
    $app->PATCH('/diretores', DiretorController::class . ':patchDiretores');
    $app->DELETE('/diretores/{diretor}', DiretorController::class . ':deleteDiretores');

    // TODO: ALUNOS

    $app->GET('/alunos[/{aluno}]', AlunoController::class . ':getAlunos');
    $app->POST('/alunos', AlunoController::class . ':setAlunos');
    $app->PUT('/alunos', AlunoController::class . ':putAlunos');
    $app->PATCH('/alunos', AlunoController::class . ':patchAlunos');
    $app->DELETE('/alunos/{aluno}', AlunoController::class . ':deleteAlunos');

    // TODO: RESPONSAVEIS

    $app->GET('/responsaveis[/{responsavel}]', ResponsavelController::class . ':getResponsaveis');
    $app->POST('/responsaveis', ResponsavelController::class . ':setResponsaveis');
    $app->PUT('/responsaveis', ResponsavelController::class . ':putResponsaveis');
    $app->PATCH('/responsaveis', ResponsavelController::class . ':patchResponsaveis');
    $app->DELETE('/responsaveis/{responsavel}', ResponsavelController::class . ':deleteResponsaveis');

    // TODO: TURMAS

    $app->POST('/turmas[/{turma}]', TurmaController::class . ':setTurmas');
    $app->GET('/turmas', TurmaController::class . ':getTurmas');
    $app->PUT('/turmas', TurmaController::class . ':putTurmas');
    $app->PATCH('/turmas', TurmaController::class . ':patchTurmas');
    $app->DELETE('/turmas/{turma}', TurmaController::class . ':deleteTurmas');

    // TODO: DOCUMENTOS

    $app->GET('/documentos[/{documento}]', DocumentoController::class . ':getDocumentos');
    $app->POST('/documentos', DocumentoController::class . ':setDocumentos');
    $app->PUT('/documentos', DocumentoController::class . ':putDocumentos');
    $app->PATCH('/documentos', DocumentoController::class . ':patchDocumentos');
    $app->DELETE('/documentos/{documento}', DocumentoController::class . ':deleteDocumentos');

    // TODO: PROFESSORES

    $app->GET('/professores[/{professor}]', ProfessorController::class . ':getProfessores');
    $app->POST('/professores', ProfessorController::class . ':setProfessores');
    $app->PUT('/professores', ProfessorController::class . ':putProfessores');
    $app->PATCH('/professores', ProfessorController::class . ':patchProfessores');
    $app->DELETE('/professores/{professor}', ProfessorController::class . ':deleteProfessores');

    // TODO: GRUPOS

    $app->POST('/grupos', GrupoController::class . ':setGrupos');
    $app->PUT('/grupos', GrupoController::class . ':putGrupos');
    $app->PATCH('/grupos', GrupoController::class . ':patchGrupos');
    $app->DELETE('/grupos/{grupo}', GrupoController::class . ':deleteGrupos');

    // TODO: USUARIOS

    $app->GET('/usuarios[/{usuario}]', UsuarioController::class . ':getUsuarios');
    $app->GET('/usuarios/permissoes/', UsuarioController::class . ':getPermissoes');
    $app->PUT('/usuarios', UsuarioController::class . ':putUsuarios');
    $app->PATCH('/usuarios', UsuarioController::class . ':patchUsuarios');
    $app->DELETE('/usuarios/{usuario}', UsuarioController::class . ':deleteUsuarios');

    // TODO: DISCIPLINAS

    $app->GET('/disciplinas[/{disciplina}]', DisciplinaController::class . ':getDisciplinas');
    $app->POST('/disciplinas', DisciplinaController::class . ':setDisciplinas');
    $app->PUT('/disciplinas', DisciplinaController::class . ':putDisciplinas');
    $app->PATCH('/disciplinas', DisciplinaController::class . ':patchDisciplinas');
    $app->DELETE('/disciplinas/{disciplina}', DisciplinaController::class . ':deleteDisciplinas');
})->add(jwtAuth());

$app->run();
