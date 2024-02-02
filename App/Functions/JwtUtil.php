<?php

namespace App\Functions;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

abstract class JwtUtil
{
    static function EncodeJwt(array $payload)
    {
        try {
            $encoded = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'] ?? '', 'HS256');
        } catch (\Throwable $th) {
            throw ($th);
            $encoded = false;
        }
        return $encoded;
    }
    static function Decode(string $token)
    {

        if (str_contains($token, 'Bearer')) $token = str_replace([' ', 'Bearer'], '', $token);
        try {
            $secret =  new Key($_ENV['JWT_SECRET_KEY'] ?? '', 'HS256');
            $jwt_data = json_decode(json_encode(
                JWT::decode(
                    $token,
                    $secret
                )
            ), true);
        } catch (\Throwable $th) {
            echo $th;
            $jwt_data = false;
        }
        return $jwt_data;
    }
}
