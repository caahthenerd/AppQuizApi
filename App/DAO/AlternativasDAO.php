<?php

namespace App\DAO;

use PDO;

class AlternativasDao extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllAlternatives($chaveIdQuestao): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT id_alternativa, chave_id_questao, conteudo_alternativa FROM quiz_app.alternativas WHERE chave_id_questao = :chave_id_questao; ORDER BY RAND()"
            );
            $query->execute([
                'chave_id_questao' => $chaveIdQuestao
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC) ?? [];
    }

    public function getAlternativeCorrect($chaveIdQuestao): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT id_alternativa, chave_id_questao, conteudo_alternativa, verdadeira FROM quiz_app.alternativas WHERE chave_id_questao = :chave_id_questao AND verdadeira = 1;"
            );
            $query->execute([
                'chave_id_questao' => $chaveIdQuestao
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC)[0] ?? [];
    }

    public function insertAlternative($chaveIdQuestao, $idAlternativa, $verdadeira, $conteudoAlternativa): bool
    {
        $query = $this->pdo
            ->prepare(
                "INSERT INTO quiz_app.alternativas(
                    id_alternativa,
                    chave_id_questao, 
                    conteudo_alternativa, 
                    verdadeira
                ) VALUES(
                    :id_alternativa,
                    :chave_id_questao, 
                    :conteudo_alternativa, 
                    :verdadeira
                )"
            );
        return $query->execute([
            'id_alternativa' => $idAlternativa,
            'chave_id_questao' => $chaveIdQuestao, 
            'conteudo_alternativa' => $conteudoAlternativa, 
            'verdadeira' => $verdadeira
        ]);
    }
}