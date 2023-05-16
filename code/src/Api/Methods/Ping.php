<?php

namespace App\Api\Methods;

use App\Api\ApiMethod;

class Ping extends ApiMethod
{
    public static function execute(array $params): mixed
    {
        return 'pong';
    }
}