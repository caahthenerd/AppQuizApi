<?php

use App\Controllers\QuizController;
use App\Controllers\QuestoesController;
use App\Controllers\AlternativasController;
use App\Controllers\Frontend\FrontLoginController;
use App\Controllers\Frontend\FrontQuizController;
use App\Controllers\Frontend\FrontSelecionarController;
use App\Controllers\Frontend\FrontRankingController;
use App\Controllers\RespostasController;
use App\Controllers\InitGameController;
use App\Controllers\LoginController;
use App\Middlewares\FrontMiddleware;
use Slim\App;

use function src\slimConfiguration;

$app = new App(slimConfiguration());

//Frontend
$app->get("/login", new FrontLoginController);
$app->get("/", function (){
    header("location: ./login");
    exit;
});


$app->group("/app", function (App $app) {    
    $app->get("/choices", new FrontSelecionarController);
    $app->get("/quiz", new FrontQuizController);
    $app->get("/ranking", new FrontRankingController);
    $app->get("/logout",LoginController::class . ':logOut');
})->add(new FrontMiddleware);


//Rotas do Quiz
$app->get('/buscar_quizzes', QuizController::class . ':GetQuizzes');
$app->get('/buscar_quiz/{id_quiz}', QuizController::class . ':getQuiz');
$app->post('/criar_quiz', QuizController::class . ':createQuiz');
$app->put('/excluir_quiz/{id_quiz}', QuizController::class . ':deleteQuiz');

//Rotas Questões do Quiz
$app->post('/criar_questao/{id_quiz}', QuestoesController::class . ':createQuestion');
$app->get('/buscar_questoes/{id_quiz}', QuestoesController::class . ':getQuestions');
$app->get('/buscar_questoes_por_usuario/{id_rodada}', QuestoesController::class . ':getQuestionsForUser');
$app->get('/buscar_questao/{id_questao}', QuestoesController::class . ':getQuestion');
$app->get('/buscar_questao_aleatoria/{id_rodada}', QuestoesController::class . ':getQuestionsForUser');
$app->put('/excluir_questao/{id_questao}', QuestoesController::class . ':deleteQuestion');

//Rotas Alternativas das Questoes
$app->post('/criar_alternativa/{id_questao}', AlternativasController::class . ':createAlternative');
$app->get('/buscar_alternativas/{id_questao}', AlternativasController::class . ':getAlternatives');
$app->post('/buscar_alternativa_correta', AlternativasController::class . ':verificaCorreta');

//Rotas das Respostas
$app->post('/inserir_resposta/{id_rodada}', RespostasController::class . ':createResponse');
$app->get('/buscar_respostas_usuario/{id_rodada}', RespostasController::class . ':getResponse');
$app->get('/buscar_respostas_corretas_usuario/{id_rodada}', RespostasController::class . ':getRespostasCorretas');
$app->get('/buscar_respostas_quiz/{id_quiz}', RespostasController::class . ':getAllResponse');

//Rota de vezes jogadas
$app->post('/inserir_inicio_rodada/{id_quiz}', InitGameController::class . ':createInicioRodada');
$app->put('/atualizar_final_rodada/{id_rodada}', InitGameController::class . ':atualizeFinalRodada');

//Ranking
$app->get('/buscar_ranking', InitGameController::class . ':getRanquados');

//Login
$app->post('/logar', LoginController::class . ':buscarUsuario');

$app->run();
