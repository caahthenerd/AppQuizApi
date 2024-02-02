<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Utils\CarregarImagem;
use App\Functions\JwtUtil;
use App\Functions\UuidUtil;
use App\DAO\QuizDAO;


final class QuizController
{

    public function getQuizzes(Request $request, Response $response, $args)
    {
        $quizDAO = new QuizDAO();
        $quizzes = $quizDAO->getAllQuizzes();
        $response = $response->withJson($quizzes);
        return $response;
    }

    public function getQuiz(Request $request, Response $response, $args)
    {
        $id_quiz = $args['id_quiz'];
        $quizDAO = new QuizDAO();
        $quizzes = $quizDAO->getOneQuiz($id_quiz);
        $response = $response->withJson($quizzes);
        return $response;
    }

    public function createQuiz(Request $request, Response $response, $args)
    {
        $token = $request->getHeaders()['HTTP_AUTHORIZATION'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $idQuiz = UuidUtil::GeradorUuid();
        $idUsuario = $tokenDecoded['idUsuario'];
        $nomeQuiz = $request->getParsedBody()['nome_quiz'];
        $imagemCarregada = $_FILES["logo_quiz"] ?? false;
        $pasta = __DIR__ . "../../uploads/";
        $foto = CarregarImagem::carregarImagem($imagemCarregada, $pasta);
        $quizDAO = new QuizDAO;
        $quizDAO->insertQuiz($idQuiz, $idUsuario, $nomeQuiz, $foto);
        if (!$quizDAO) 
        {
            return $response->withJson("Erro ao criar quiz!");
        }
        return $response->withJson("Quiz criado com sucesso!");
    }

    public function deleteQuiz(Request $request, Response $response, $args)
    {
        
    }
    
}