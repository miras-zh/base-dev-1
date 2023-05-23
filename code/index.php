<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

const ROOT_DIR = __DIR__;
require_once ROOT_DIR . '/models/Database.php';

require 'config.php';
require 'autoload.php';

use controllers\Api\ApiController;

$router = new app\Router();







$real_route = preg_replace('|\?.*?$|', '', $_SERVER['REQUEST_URI']);
$real_route = trim($real_route, '/');
$real_route_parts = explode('/', $real_route);

if ($real_route_parts !== [] && $real_route_parts[0] === 'api') {
    $input = file_get_contents('php://input');

    if ($input === false || $input === '') {
        $input = null;
    }

    array_shift($real_route_parts);
    ApiController::handleRequest($real_route_parts, $_GET, $_POST, $input);

    $result = \controllers\Api\Methods\Users::execute();

    exit;
}

$router->run();
