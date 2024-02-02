<?php

namespace App\DAO;

use PDO;

class RespostasDao extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getResponseUser($idUsuario, $chaveIdRodada): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT qr.id_resposta,
                qr.chave_id_questao, 
                qr.chave_id_alternativa, 
                qr.idUsuario, 
                qr.data_resposta,
                qa.verdadeira
                FROM quiz_app.respostas qr
                INNER JOIN quiz_app.alternativas qa
                ON qr.chave_id_alternativa = qa.id_alternativa
                WHERE chave_id_rodada = :chave_id_rodada
                AND idUsuario = :idUsuario;"
            );
            $query->execute([
                'idUsuario' => $idUsuario,
                'chave_id_rodada' => $chaveIdRodada
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }


    public function getRespostasPontuacao($idUsuario, $chaveIdRodada): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT qr.chave_id_questao, 
                qr.chave_id_alternativa, 
                qr.idUsuario,
                qa.verdadeira,
                SUM(IF(qa.verdadeira = 0,  qqe.pontuacao = 0, qqe.pontuacao)) as pontuacao
                FROM quiz_app.respostas qr
                INNER JOIN quiz_app.questoes qqe
                ON qr.chave_id_questao = qqe.id_questao
                INNER JOIN quiz_app.alternativas qa
                ON qr.chave_id_alternativa = qa.id_alternativa
                WHERE qr.chave_id_rodada = :chave_id_rodada
                AND qr.idUsuario = :idUsuario;"
            );
            $query->execute([
                'idUsuario' => $idUsuario,
                'chave_id_rodada' => $chaveIdRodada
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function insertResponse($idResposta, $chaveIdQuestao, $chaveIdAlternativa, $idUsuario, $chaveIdRodada): bool
    {
        $query = $this->pdo
            ->prepare(
                "INSERT INTO quiz_app.respostas(
                    id_resposta,
                    chave_id_questao,
                    chave_id_alternativa,
                    id_usuario,
                    chave_id_rodada
                ) VALUES(
                    :id_resposta,
                    :chave_id_questao,
                    :chave_id_alternativa,
                    :idUsuario,
                    :chave_id_rodada
                )"
            );
        return $query->execute([
            'id_resposta' => $idResposta,
            'chave_id_questao' => $chaveIdQuestao,
            'chave_id_alternativa' => $chaveIdAlternativa,
            'idUsuario' => $idUsuario,
            'chave_id_rodada' => $chaveIdRodada
        ]);
    }

    public function buscarQuantidadeAcertosPontos($chaveIdRodada){
        $query = $this->pdo
        ->prepare(
            "SELECT SUM(IF(qa.verdadeira = 0, 0, 1)) as corretas,
            SUM(IF(qa.verdadeira = 0, 1, 0)) as erradas,
            SUM(IF(qa.verdadeira = 0,  qqe.pontuacao = 0, qqe.pontuacao)) as pontuacao,
            TIMEDIFF(qrd.data_hora_final, qrd.data_hora_inicio) AS tempo
            FROM quiz_app.respostas qr
            INNER JOIN quiz_app.questoes qqe
            ON qr.chave_id_questao = qqe.id_questao
            INNER JOIN quiz_app.alternativas qa
            ON qr.chave_id_alternativa = qa.id_alternativa
            INNER JOIN quiz_app.rodadas qrd
            ON qr.chave_id_rodada = qrd.id_rodada
            WHERE qr.chave_id_rodada = :chave_id_rodada"
        );
        $query->execute([
            'chave_id_rodada' => $chaveIdRodada
        ]);
        return $query->fetchAll(\PDO::FETCH_ASSOC)[0] ?? [];
    }
}