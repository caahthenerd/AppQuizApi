<?php

namespace App\Functions;

use Ramsey\Uuid\Uuid;

abstract class UuidUtil
{
    static function GeradorUuid()
    {
        $uuid = Uuid::uuid4();
        $uuidGerado = $uuid->toString();

        return $uuidGerado;
    }

}