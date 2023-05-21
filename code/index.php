<?php

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
$router->run();







$real_route = preg_replace('|\?.*?$|', '', $_SERVER['REQUEST_URI']);
var_dump($_SERVER['REQUEST_URI']);
echo '<br />';

$real_route = trim($real_route, '/');
var_dump('$real_route: ',$real_route);
echo '<br />';

var_dump('$real_route: ',$real_route);
echo '<br />';

$real_route_parts = explode('/', $real_route);
var_dump('$real_route_parts:',$real_route_parts);
echo '<br />';


if ($real_route_parts !== [] && $real_route_parts[0] === 'api') {
    $input = file_get_contents('php://input');

    var_dump('$input file_get_content:',$input);
    echo '<br />';

    if ($input === false || $input === '') {
        $input = null;
    }

    array_shift($real_route_parts);
    ApiController::handleRequest($real_route_parts, $_GET, $_POST, $input);

    $result = \controllers\Api\Methods\Users::execute();
    var_dump('-------------------- :::::::: >>>>>',$result);

    exit;
}
