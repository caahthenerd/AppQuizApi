<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Functions\UuidUtil;
use App\Functions\JwtUtil;
use App\DAO\QuestoesDao;


final class QuestoesController
{

    public function getQuestionsForUser(Request $request, Response $response, $args)
    {
        $chaveIdRodada = $args['id_rodada'];
        $questaoDAO = new QuestoesDao;
        $questoes = $questaoDAO->getOneQuestion($chaveIdRodada);
        if (count($questoes) == 0) {
            return $response->withJson(array("message"=>"Quiz finalizado!"));
        }
        return $response->withJson($questoes);
    }

    public function getQuestions(Request $request, Response $response, $args)
    {
        $chaveIdQuiz = $args['id_quiz'];
        $questaoDAO = new QuestoesDao;
        $questoes = $questaoDAO->getAllQuestoes($chaveIdQuiz);
        $response = $response->withJson($questoes);
        return $response;
    }

    public function getQuestion(Request $request, Response $response, $args)
    {
        $idQuestao = $args['id_questao'];
        $questaoDAO = new QuestoesDao();
        $questao = $questaoDAO->getOneQuestion($idQuestao);
        $response = $response->withJson($questao);
        return $response;
    }

    public function getRandomQuestion(Request $request, Response $response, $args)
    {
        $idRodada = $args['id_rodada'];
        $questaoDAO = new QuestoesDao();
        $questao = $questaoDAO->getOneRandomQuestion($idRodada);
        $response = $response->withJson($questao);
        return $response;
    }

    public function createQuestion(Request $request, Response $response, $args)
    {
        $chaveIdQuiz = $args['id_quiz'];
        $idQuestao = UuidUtil::GeradorUuid();
        $pontuacao = $request->getParsedBody()['pontuacao'];
        $conteudoQuestao = $request->getParsedBody()['conteudo_questao'];
        $grauDificuldade = $request->getParsedBody()['grau_dificuldade'];
        $questaoDAO = new QuestoesDao;
        $questaoDAO->insertQuestion($chaveIdQuiz, $idQuestao, $pontuacao, $conteudoQuestao, $grauDificuldade);
        if (!$questaoDAO) 
        {
            return $response->withJson("Erro ao inserir questao no bd!");
        }
        return $response->withJson("Questao inserida no bd!");
    }

    public function deleteQuestion(Request $request, Response $response, $args)
    {
        
    }
    
}