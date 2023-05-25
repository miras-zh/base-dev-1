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

    private array $routes = [
        '|^/?$|' => ['controller' => 'home\\HomeController', 'action' => 'index'],
        '|^/users(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$|' => ['controller' => 'users\\UserController'],
        '|^/companies(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$|' => ['controller' => 'company\\CompanyController'],
        '|^/roles(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$|' => ['controller' => 'role\\RoleController'],
        '|^/pages(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$|' => ['controller' => 'pages\\PagesController'],
        '|^/todo\/category(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$|' => ['controller' => 'todo\\TodoCategory'],
        '|^/auth(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$|' => ['controller' => 'auth\\AuthController'],
    ];

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];

        $controller = null;
        $action = null;
        $params = null;

        foreach ($this->routes as $pattern => $route){
            if(preg_match($pattern,$uri,$matches)){
                $controller = "controllers\\" . $route['controller'];
                $action = $route['action'] ?? $matches['action'] ?? 'index';
//                получаем параметры из совпавших с регулярным выражением подстрок
                $params = array_filter($matches, 'is_string',ARRAY_FILTER_USE_KEY);
                break;
            }
        }

        if(!$controller){
            http_response_code(404);
            echo 'page not found';
            return;
        }

        $controllerInstance = new $controller();
        if(!method_exists($controllerInstance, $action)){
            http_response_code(404);
            echo 'page not found';
            return;
        }

        call_user_func_array([$controllerInstance, $action],[$params]);
    }
}





