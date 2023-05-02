<?php

class Router
{
    public function run()
    {

//        $page = preg_replace('|\?.*?$|', '', $_SERVER['REQUEST_URI']);
//        echo $page;
//        $page = trim($page, '/');
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        var_dump($_GET);

        switch ($page) {
            case '':
            case 'home':
                $controller = new HomeController();
                $controller->index();
                break;
            case 'users':
                $controller = new UserController();

                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'create':
                            $controller->create();
                            break;
                        case 'store':
                            $controller->store();
                            break;
                    }
                } else {
                    $controller->index();
                }

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