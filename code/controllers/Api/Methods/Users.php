<?php

namespace controllers\Api\Methods;

use controllers\Api\ApiMethod;
use controllers\users\UserController;
use models\user\User;

class Users extends ApiMethod
{
    public static function execute(array $params = []): mixed
    {
        $userModel = new User();
        return $userModel->readAll();
    }
}