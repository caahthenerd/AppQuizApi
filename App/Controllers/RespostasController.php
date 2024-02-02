<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Functions\UuidUtil;
use App\Functions\JwtUtil;
use App\DAO\RespostasDao;


final class RespostasController
{

    public function getResponse(Request $request, Response $response, $args)
    {
        $chaveIdRodada = $args['id_rodada'];
        $token = $request->getHeaders()['HTTP_AUTHORIZATION'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $idUsuario = $tokenDecoded['idUsuario'];
        $respostasDAO = new RespostasDao;
        $respostas = $respostasDAO->getResponseUser($idUsuario, $chaveIdRodada);
        $response = $response->withJson($respostas);
        return $response;
    }

    public function getRespostasCorretas(Request $request, Response $response, $args)
    {
        $chaveIdRodada = $args['id_rodada'];
        $token = $request->getHeaders()['HTTP_AUTHORIZATION'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $idUsuario = $tokenDecoded['idUsuario'];
        $respostasDAO = new RespostasDao;
        $respostas = $respostasDAO->getRespostasPontuacao($idUsuario, $chaveIdRodada);
        $response = $response->withJson($respostas);
        return $response;
    }

    public function createResponse(Request $request, Response $response, $args)
    {
        $chaveIdRodada = $args['id_rodada'];
        $idResposta = UuidUtil::GeradorUuid();
        $token = $request->getHeaders()['HTTP_AUTHORIZATION'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $idUsuario = $tokenDecoded['idUsuario'];
        $chaveIdQuestao = $request->getParsedBody()['id_questao'];
        $chaveIdAlternativa = $request->getParsedBody()['id_alternativa'];
        $respostaDAO = new RespostasDao;
        $respostaDAO->insertResponse($idResposta, $chaveIdQuestao, $chaveIdAlternativa, $idUsuario, $chaveIdRodada);
        if (!$respostaDAO) 
        {
            return $response->withJson("Erro ao inserir resposta no bd!");
        }
        return $response->withJson("Resposta inserida no bd!");
    }
    
}