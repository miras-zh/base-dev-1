<?php

namespace App\Controllers\Api\Methods;

use App\Controllers\Api\ApiMethod;

class Ping extends ApiMethod
{
    public static function execute(array $params): mixed
    {
        return 'pong';
    }
}