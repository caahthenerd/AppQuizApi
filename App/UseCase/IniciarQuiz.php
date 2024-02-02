<?php

namespace App\UseCase;

use App\Functions\UuidUtil;
use App\DAO\InitGameDAO;

abstract class IniciarQuiz
{
    static function execute($chaveIdQuiz, $idUsuario)
    {
        $idRodada = UuidUtil::GeradorUuid();
        $rodadaInicioDAO = new InitGameDAO;
        $rodadaInicioDAO->insertInicioRodada($chaveIdQuiz, $idRodada, $idUsuario);
        if (!$rodadaInicioDAO) 
        {
            return false;
        }
        return array("id_rodada"=>$idRodada);
    }
}