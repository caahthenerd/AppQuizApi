<?php

namespace App\DAO;

use App\Models\QuizModel;
use PDO;

class QuizDao extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllQuizzes(): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT id_quiz, criador, nome_quiz, logo_quiz, logado, status, data_criacao FROM quiz_app.quizzes"
            );
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function getOneQuiz($id_quiz): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT id_quiz, criador, nome_quiz, logo_quiz, logado, status, data_criacao FROM quiz_app.quizzes WHERE id_quiz = :id_quiz"
            );
            $query->execute([
                'id_quiz' => $id_quiz
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function insertQuiz($idQuiz, $idUsuario, $nomeQuiz, $foto): bool
    {
        $query = $this->pdo
            ->prepare(
                "INSERT INTO quiz_app.quizzes(
                    id_quiz,
                    criador,
                    nome_quiz,
                    logo_quiz
                ) VALUES(
                    :id_quiz,
                    :criador,
                    :nome_quiz,
                    :logo_quiz
                )"
            );
        return $query->execute([
            "id_quiz" => $idQuiz,
            "criador" => $idUsuario,
            "nome_quiz" => $nomeQuiz,
            "logo_quiz" => $foto
        ]);
    }
}