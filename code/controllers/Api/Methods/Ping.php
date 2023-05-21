<?php

namespace controllers\Api\Methods;

use controllers\Api\ApiMethod;

class Ping extends ApiMethod
{
    public static function execute(array $params): mixed
    {
        return 'pong';
    }
}