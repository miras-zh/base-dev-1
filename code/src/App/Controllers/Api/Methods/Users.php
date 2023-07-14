<?php

namespace App\Controllers\Api\Methods;

use App\Controllers\Api\ApiMethod;
use App\Models\user\User;

class Users extends ApiMethod
{
    public static function execute(array $params = []): mixed
    {
        $userModel = new User();
        return $userModel->readAll();
    }
}