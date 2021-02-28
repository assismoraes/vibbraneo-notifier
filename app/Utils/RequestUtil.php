<?php

namespace App\Utils;

class RequestUtil
{

    public static function isFromApi($r) {
        return $r->is('api/*');
    }

}