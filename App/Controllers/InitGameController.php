<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Functions\UuidUtil;
use App\Functions\JwtUtil;
use App\UseCase\IniciarQuiz;
use App\UseCase\VerificarExistenciaQuiz;
use App\DAO\InitGameDAO;
use App\DAO\RespostasDao;

final class InitGameController
{

    public function createInicioRodada(Request $request, Response $response, $args)
    {
        $chaveIdQuiz = $args['id_quiz'];
        $token = $request->getHeaders()['HTTP_AUTHORIZATION'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $idUsuario = $tokenDecoded['idUsuario'];
        $criador = VerificarExistenciaQuiz::execute($chaveIdQuiz, $idUsuario);
        if (!$criador) {
            $criador = IniciarQuiz::execute($chaveIdQuiz, $idUsuario);
        }
        return $response->withJson($criador);
    }

    public function atualizeFinalRodada(Request $request, Response $response, $args)
    {
        $respostaDAO = new RespostasDao;
        $rodadaInicioDAO = new InitGameDAO;
        $chaveIdRodada = $args['id_rodada'];
        $scoreFinal = $respostaDAO->buscarQuantidadeAcertosPontos($chaveIdRodada);
        $rodadaInicioDAO->updateFinalRodada(
            $chaveIdRodada,
            $scoreFinal["pontuacao"],
            $scoreFinal["corretas"],
            $scoreFinal["erradas"]
        );
        if (!$rodadaInicioDAO) {
            return $response->withJson("Erro ao finalizar rodada!");
        }
        return $response->withJson(array(
            "message" => "Rodada finalizada com suceso!",
            "score" => $scoreFinal
        ));
    }

    public function getRanquados(Request $request, Response $response, $args)
    {
        $ranqueadoDAO = new InitGameDAO;
        $ranking = $ranqueadoDAO->getRanking();
        $response = $response->withJson(array(
            "ranking" => $ranking
        ));
        return $response;
    }
}
