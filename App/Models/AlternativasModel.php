<?php

namespace App\Models;

final class QuizModel
{

        /**
         *  @var string
         * */
        private $id_alternativa;


        /**
         *  @var string
         * */
        private $chave_id_questao;

        
        /**
         *  @var string
         * */
        private $conteudo_alternativa;


        /**
         *  @var bool
         * */
        private $verdadeira;


    /**
     *  @return string
     * */
    public function getIdAlternativa(): string
    {
        return $this -> id_alternativa;
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
    public function setChaveIdQuiz(string $chave_id_questao): QuizModel
    {
        $this -> chave_id_questao = $chave_id_questao;
        return $this;
    }


    /**
     * @return string
     * */    
    public function getConteudoAlternativa(): string
    {
        return $this -> conteudo_alternativa;
    }

    /**
     * @param string
     * @return QuizModel
     * */
    public function setConteudoAlternativa(string $conteudo_alternativa): QuizModel
    {
        $this -> conteudo_alternativa = $conteudo_alternativa;
        return $this;
    }


    /**
     * @return bool
     * */
    public function getVerdadeira(): bool
    {
        return $this -> verdadeira;
    }


    /**
     * @param bool
     * @return QuizModel
     * */
    public function setVerdadeira(bool $verdadeira): QuizModel
    {
        $this -> verdadeira = $verdadeira;
        return $this;

    }
}