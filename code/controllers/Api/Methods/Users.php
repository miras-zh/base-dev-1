<?php

namespace controllers\Api\Methods;

use controllers\Api\ApiMethod;

class Users extends ApiMethod
{
    public static function execute(array $params = []): string
    {
        return 'users';
    }
}