<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Functions\UuidUtil;
use App\DAO\AlternativasDao;
use App\DAO\RespostasDao;
use App\Functions\JwtUtil;

final class AlternativasController
{

    public function getAlternatives(Request $request, Response $response, $args)
    {
        $chaveIdQuestao = $args['id_questao'];
        $alternativaDAO = new AlternativasDao;
        $alternativas = $alternativaDAO->getAllAlternatives($chaveIdQuestao);
        $response = $response->withJson($alternativas);
        return $response;
    }

    public function verificaCorreta(Request $request, Response $response, $args)
    {
        $idResposta = UuidUtil::GeradorUuid();
        $token = $request->getHeaders()['HTTP_AUTHORIZATION'][0];
        $tokenDecoded = JwtUtil::decode($token);
        $idUsuario = $tokenDecoded['idUsuario'];
        $respostaDAO = new RespostasDao;
        $chaveIdRodada = $request->getParsedBody()['id_rodada'];
        $idAlternativa = $request->getParsedBody()['id_alternativa'];
        $chaveIdQuestao = $request->getParsedBody()['chave_id_questao'];
        $respostaDAO->insertResponse($idResposta, $chaveIdQuestao, $idAlternativa, $idUsuario, $chaveIdRodada);
        if (!$respostaDAO) {
            return $response->withJson("Erro ao inserir resposta no bd!");
        }
        $alternativaDAO = new AlternativasDao();
        $alternativa = $alternativaDAO->getAlternativeCorrect($chaveIdQuestao);
        $response = $response->withJson(array(
            "alternativa" => $alternativa,
            "mandou_correta" => $alternativa["id_alternativa"] == $idAlternativa
        ));
        return $response;
    }

    public function createAlternative(Request $request, Response $response, $args)
    {
        $chaveIdQuestao = $args['id_questao'];
        $idAlternativa = UuidUtil::GeradorUuid();
        $verdadeira = $request->getParsedBody()['verdadeira'];
        $conteudoAlternativa = $request->getParsedBody()['conteudo_alternativa'];
        $alternativaDAO = new AlternativasDao;
        $alternativaDAO->insertAlternative($chaveIdQuestao, $idAlternativa, $verdadeira, $conteudoAlternativa);
        if (!$alternativaDAO) {
            return $response->withJson("Erro ao inserir alternativa no bd!");
        }
        return $response->withJson("Alternativa inserida no bd!");
    }
}
