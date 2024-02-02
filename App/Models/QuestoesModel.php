<?php

namespace App\Models;

final class QuizModel
{

        /**
         *  @var string
         * */
        private $id_questao;


        /**
         *  @var string
         * */
        private $chave_id_quiz;

        
        /**
         *  @var int
         * */
        private $pontuacao;

        
        /**
         *  @var string
         * */
        private $conteudo_questao;

        /**
         *  @var int
         * */
        private $grau_dificuldade;

        /**
         *  @var bool
         * */
        private $status_questao;


    /**
     *  @return string
     * */
    public function getIdQuestao(): string
    {
        return $this -> id_questao;
    }

    /**
     * @return string
     * */    
    public function getChaveIdQuiz(): string
    {
        return $this -> chave_id_quiz;
    }

    /**
     * @param string
     * @return QuizModel
     * */
    public function setChaveIdQuiz(string $chave_id_quiz): QuizModel
    {
        $this -> chave_id_quiz = $chave_id_quiz;
        return $this;
    }

    /**
     * @return int
     * */    
    public function getPontuacao(): int
    {
        return $this -> pontuacao;
    }

    /**
     * @param int
     * @return QuizModel
     * */
    public function setPontuacao(int $pontuacao): QuizModel
    {
        $this -> pontuacao = $pontuacao;
        return $this;
    }

    /**
     * @return string
     * */    
    public function getConteudoQuestao(): string
    {
        return $this -> conteudo_questao;
    }

    /**
     * @param string
     * @return QuizModel
     * */
    public function setConteudoQuestao(string $conteudo_questao): QuizModel
    {
        $this -> conteudo_questao = $conteudo_questao;
        return $this;
    }

    /**
     * @return int
     * */    
    public function getGrauDificuldade(): int
    {
        return $this -> grau_dificuldade;
    }

    /**
     * @param int
     * @return QuizModel
     * */
    public function setGrauDificuldade(int $grau_dificuldade): QuizModel
    {
        $this -> grau_dificuldade = $grau_dificuldade;
        return $this;
    }


    /**
     * @return bool
     * */
    public function getStatusQuestao(): bool
    {
        return $this -> status_questao;
    }


    /**
     * @param bool
     * @return QuizModel
     * */
    public function setStatusQuestao(bool $status_questao): QuizModel
    {
        $this -> status_questao = $status_questao;
        return $this;

    }
}