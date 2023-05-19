<?php

namespace app;

use controllers\auth\AuthController;
use controllers\company\CompanyController;
use controllers\home\HomeController;
use controllers\pages\PagesController;
use controllers\role\RoleController;
use controllers\users\UserController;


class Router
{

    private $routes = [
        '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'],
        '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'company\\CompanyController', 'action' => 'index'],
        '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'pages\\PagesController', 'action' => 'index'],
        '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'role\\RoleController', 'action' => 'index'],
        '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'users\\UserController', 'action' => 'index'],

    ];

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $controller = null;
        $action = null;
        $params = null;
    }
}




//
//$real_route = preg_replace('|\?.*?$|', '', $_SERVER['REQUEST_URI']);
//$real_route = trim($real_route, '/');
//$real_route_parts = explode('/', $real_route);
//if ($real_route_parts !== [] && $real_route_parts[0] === 'api') {
//    $input = file_get_contents('php://input');
//    if ($input === false || $input === '') {
//        $input = null;
//    }
//
//    array_shift($real_route_parts);
//    \App\Api\ApiController::handleRequest($real_route_parts, $_GET, $_POST, $input);
//    exit;
//}
