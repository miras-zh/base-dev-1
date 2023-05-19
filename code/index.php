<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

const ROOT_DIR = __DIR__;
require_once ROOT_DIR . '/app/models/Database.php';

require 'config.php';
require 'autoload.php';

$router = new app\Router();
$router->run();

