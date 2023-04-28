<?php

echo 'test</br>';
error_reporting(E_ALL);
ini_set('display_errors', 1);
const ROOT_DIR = __DIR__;

/* Установите желаемую кодировку после установления соединения */

require_once ROOT_DIR . '/app/models/Database.php';
$db = Database::getInstance();
require_once 'app/controllers/users/AuthController.php';
require_once 'app/controllers/users/UserController.php';
require_once 'app/models/User.php';
require_once 'app/router.php';

$router = new Router();
$router->run();

