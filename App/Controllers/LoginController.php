<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Functions\LdapFunctions;
use App\Functions\JwtUtil;
use App\DAO\LoginDAO;


final class LoginController
{

    public function buscarUsuario(Request $request, Response $response, $args)
    {
        $login = $request->getParsedBody()['login'];
        $senha = $request->getParsedBody()['senha'];
        $loginDAO = new LoginDAO;
        $dados = $loginDAO->getdDadosUser($login, $senha);
        $token = JwtUtil::EncodeJwt(
            array(
                "idUsuario"=>$dados["idUsuario"],
                "NOME"=>$dados["NOME"],
                "LOGIN"=>$dados["LOGIN"],
                "exp" => strtotime(date("Y-m-d H:i:s", strtotime("+1 days")))
            )
        );
        return $response->withJson(array('token' => $token));
    }
}
