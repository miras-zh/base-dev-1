<?php

namespace App\Controllers\Api;

abstract class ApiMethod
{
    abstract public static function execute(array $params): mixed;
}