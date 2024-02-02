<?php

namespace App\DAO;

use PDO;

class InitGameDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRodada($idQuiz, $idUsuario): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT id_rodada FROM quiz_app.rodadas
                WHERE idUsuario = :idUsuario
                AND chave_id_quiz = :chave_id_quiz
                AND isnull(data_hora_final)
                LIMIT 1;"
            );
            $query->execute([
                'idUsuario' => $idUsuario,
                'chave_id_quiz' => $idQuiz
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC)[0] ?? [];
    }


    public function insertInicioRodada($chaveIdQuiz, $idRodada, $idUsuario): bool
    {
        $query = $this->pdo
            ->prepare(
                "INSERT INTO quiz_app.rodadas(
                    id_rodada,
                    chave_id_quiz,
                    idUsuario
                ) VALUES(
                    :id_rodada,
                    :chave_id_quiz,
                    :idUsuario
                )"
            );
        return $query->execute([
            'id_rodada' => $idRodada,
            'chave_id_quiz' => $chaveIdQuiz, 
            'idUsuario' => $idUsuario
        ]);
    }


    public function updateFinalRodada($chaveIdRodada,$pontuacao,$corretas,$erradas): bool
    {
        $query = $this->pdo
            ->prepare(
                "UPDATE quiz_app.rodadas
                SET data_hora_final = now(),
                pontuacao = :pontuacao,
                quantidade_corretas = :corretas,
                quantidade_erradas = :erradas
                WHERE id_rodada = :id_rodada;"
            );
        return $query->execute([
            'pontuacao' => $pontuacao,
            'corretas' => $corretas,
            'erradas' => $erradas,
            'id_rodada' => $chaveIdRodada,
        ]);
    }

    public function getRanking(): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT
                bu.NOME AS NOME,
                qr.pontuacao,
                TIMEDIFF(qr.data_hora_final,qr.data_hora_inicio) as tempo
                FROM quiz_app.rodadas qr
                INNER JOIN quiz_app.baseUsuarios bu
                ON qr.idUsuario = sf.idUsuario
                ORDER BY pontuacao DESC
                LIMIT 4;"
            );
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }
}