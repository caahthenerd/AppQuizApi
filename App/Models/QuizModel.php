<?php

namespace App\Models;

final class QuizModel
{
        /**
         *  @var string
         * */
        private $id_quiz;

        /**
         *  @var string
         * */
        private $criador;

        
        /**
         *  @var string
         * */
        private $nome_quiz;

        
        /**
         *  @var string
         * */
        private $logo_quiz;

        /**
         *  @var bool
         * */
        private $logado;

        /**
         *  @var bool
         * */
        private $status;


    /**
     *  @return string
     * */
    public function getIdQuiz(): string
    {
        return $this -> id_quiz;
    }

    /**
     *  @return string
     * */
    public function setIdQuiz(): string
    {
        return $this -> id_quiz;
    }

    /**
     * @return string
     * */    
    public function getCriador(): string
    {
        return $this -> criador;
    }

    /**
     * @param string
     * @return QuizModel
     * */
    public function setCriador(string $criador): QuizModel
    {
        $this -> criador = $criador;
        return $this;
    }

        /**
     * @return string
     * */    
    public function getNomeQuiz(): string
    {
        return $this -> nome_quiz;
    }

    /**
     * @param string
     * @return QuizModel
     * */
    public function setNomeQuiz(string $nome_quiz): QuizModel
    {
        $this -> nome_quiz = $nome_quiz;
        return $this;
    }

    /**
     * @return string
     * */    
    public function getLogoQuiz(): string
    {
        return $this -> logo_quiz;
    }

    /**
     * @param string
     * @return QuizModel
     * */
    public function setLogoQuiz(string $logo_quiz): QuizModel
    {
        $this -> logo_quiz = $logo_quiz;
        return $this;
    }

    /**
     * @return bool
     * */    
    public function getQuizLogado(): bool
    {
        return $this -> logado;
    }

    /**
     * @param bool
     * @return QuizModel
     * */
    public function setQuizLogado(bool $logado): QuizModel
    {
        $this -> logado = $logado;
        return $this;
    }


    /**
     * @return bool
     * */
    public function getStatusQuiz(): bool
    {
        return $this -> status;
    }


    /**
     * @param bool
     * @return QuizModel
     * */
    public function setStatusQuiz(bool $status): QuizModel
    {
        $this -> status = $status;
        return $this;

    }
}