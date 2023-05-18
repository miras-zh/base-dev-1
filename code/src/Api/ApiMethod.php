<?php

namespace App\Api;

abstract class ApiMethod
{
    abstract public static function execute(array $params): mixed;
}