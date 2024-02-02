<?php

namespace App\UseCase;

use App\DAO\InitGameDAO;

abstract class VerificarExistenciaQuiz
{
    static function execute($idQuiz, $idUsuario)
    {
        $rodadaDAO = new InitGameDAO();
        $rodadaAtual = $rodadaDAO->getRodada($idQuiz, $idUsuario);
        if(count($rodadaAtual) == 0){
            return false;
        }
        return $rodadaAtual;
    }
}