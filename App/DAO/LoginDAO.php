<?php

namespace App\DAO;

use PDO;

class LoginDAO extends ConexaoLogin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getdDadosUser($login, $senha): array
    {
        $query = $this->pdo
            ->prepare(
                "SELECT idUsuario,
                NOME,
                LOGIN,
                SENHA
                FROM quiz_app.baseUsuarios
                WHERE LOGIN = :LOGIN
                AND SENHA = :SENHA
                LIMIT 1;"
            );
            $query->execute([
                'LOGIN' => $login,
                'SENHA' => $senha
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC)[0] ?? [];
    }
}