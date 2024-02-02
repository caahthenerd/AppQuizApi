<?php

namespace App\Utils;

abstract class CarregarImagem
{
    static public function carregarImagem($imagemCarregada, $caminho)
    {
        if (!$imagemCarregada) {
            return [
                'message' => "Imagem não enviada."
            ];
        }
        $pastaImagem = $caminho;
        $basename = bin2hex(random_bytes(8));
        $extensao = explode('/', $imagemCarregada['type'])[1];
        $novo_nome = sprintf('%s.%0.8s', $basename, $extensao);
        if (!move_uploaded_file($imagemCarregada['tmp_name'], $pastaImagem . $novo_nome)) {
            return [
                'message' => "Erro para mover imagem."
            ];
        }

        return $novo_nome;
    }
}