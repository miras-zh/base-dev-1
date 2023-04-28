<?php

class Router
{
    public function run()
    {

        //        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $page = preg_replace('|\?.*?$|', '', $_SERVER['REQUEST_URI']);
        echo $page;
        $page = trim($page, '/');

        switch ($page){
            case 'users':
                $controller = new UserController();
                $controller->index();
                break;
            case 'user':
                $controller = new User();
                $controller->index();
                break;
            default:
                http_response_code(404);
                echo 'Page not Found';
                break;
        }
    }
}