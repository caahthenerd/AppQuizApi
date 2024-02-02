<?php

namespace App\DAO;

use PDO;

class QuestoesDao extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getQuestoesForUser($idUsuario, $chaveIdRodada): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT qqe.id_questao,
                qqe.conteudo_questao,
                qqe.pontuacao
                FROM quiz_app.questoes qqe
                WHERE qqe.id_questao NOT IN(
                    SELECT qr.chave_id_questao 
                    FROM quiz_app.respostas qr 
                    WHERE qr.chave_id_rodada = :chave_id_rodada
                    AND qr.idUsuario = :idUsuario)
                ORDER BY RAND();"
            );
            $query->execute([
                'chave_id_rodada' => $chaveIdRodada,
                'idUsuario' => $idUsuario
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function getAllQuestoes($chaveIdQuiz): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT id_questao,conteudo_questao, pontuacao FROM quiz_app.questoes WHERE chave_id_quiz = :chave_id_quiz ORDER BY RAND();"
            );
            $query->execute([
                'chave_id_quiz' => $chaveIdQuiz
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function getOneQuestion($chaveIdRodada): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT q.id_questao, q.pontuacao, q.conteudo_questao 
                FROM quiz_app.questoes q
                inner join rodadas 
                on rodadas.id_rodada = :rodada
                WHERE id_questao not in (select chave_id_questao from
                respostas where chave_id_rodada = :rodada)
                ORDER BY RAND() LIMIT 1;"
            );
            $query->execute([
                'rodada' => $chaveIdRodada
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function getOneRandomQuestion($chaveIdQuiz): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT id_questao, pontuacao, conteudo_questao FROM quiz_app.questoes WHERE chave_id_quiz = :chave_id_quiz ORDER BY RAND() LIMIT 1;"
            );
            $query->execute([
                'chave_id_quiz' => $chaveIdQuiz
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function insertQuestion($chaveIdQuiz, $idQuestao, $pontuacao, $conteudoQuestao, $grauDificuldade): bool
    {
        $query = $this->pdo
            ->prepare(
                "INSERT INTO quiz_app.questoes(
                    id_questao, 
                    chave_id_quiz, 
                    pontuacao, 
                    conteudo_questao, 
                    grau_de_dificuldade
                ) VALUES(
                    :id_questao, 
                    :chave_id_quiz, 
                    :pontuacao, 
                    :conteudo_questao, 
                    :grau_de_dificuldade
                )"
            );
        return $query->execute([
            'id_questao' => $idQuestao,
            'chave_id_quiz' => $chaveIdQuiz,
            'pontuacao' => $pontuacao,
            'conteudo_questao' => $conteudoQuestao,
            'grau_de_dificuldade' => $grauDificuldade
        ]);
    }
}