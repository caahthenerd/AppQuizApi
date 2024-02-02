<?php

namespace App\Models;

final class QuizModel
{

        /**
         *  @var string
         * */
        private $id_resposta;


        /**
         *  @var string
         * */
        private $chave_id_quiz;

        
        /**
         *  @var string
         * */
        private $chave_id_alternativa;


        /**
         *  @var int
         * */
        private $pontos;

        
        /**
         *  @var int
         * */
        private $idUsuario_respondeu;


    /**
     *  @return string
     * */
    public function getIdResposta(): string
    {
        return $this -> id_resposta;
    }

    /**
     * @return string
     * */    
    public function getChaveIdQuestao(): string
    {
        return $this -> chave_id_questao;
    }

    /**
     * @param string
     * @return QuizModel
     * */
    public function setChaveIdQuestao(string $chave_id_questao): QuizModel
    {
        $this -> chave_id_questao = $chave_id_questao;
        return $this;
    }

        /**
     * @return string
     * */    
    public function getChaveIdAlternativa(): string
    {
        return $this -> chave_id_alternativa;
    }

    /**
     * @param string
     * @return QuizModel
     * */
    public function setChaveIdQuiz(string $chave_id_alternativa): QuizModel
    {
        $this -> chave_id_alternativa = $chave_id_alternativa;
        return $this;
    }


    /**
     * @return int
     * */    
    public function getPontos(): int
    {
        return $this -> pontos;
    }

    /**
     * @param int
     * @return QuizModel
     * */
    public function setPontos(int $pontos): QuizModel
    {
        $this -> pontos = $pontos;
        return $this;
    }

    /**
     * @return int
     * */    
    public function getidUsuarioRespondeu(): int
    {
        return $this -> idUsuario_respondeu;
    }

    /**
     * @param int
     * @return QuizModel
     * */
    public function setidUsuarioRespondeu(int $idUsuario_respondeu): QuizModel
    {
        $this -> idUsuario_respondeu = $idUsuario_respondeu;
        return $this;
    }
}