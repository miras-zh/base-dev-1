<?php

class Router
{
    public function run()
    {
        $real_route = preg_replace('|\?.*?$|', '', $_SERVER['REQUEST_URI']);
        $real_route = trim($real_route, '/');
        $real_route_parts = explode('/', $real_route);
        if ($real_route_parts !== [] && $real_route_parts[0] === 'api') {
            $input = file_get_contents('php://input');
            if ($input === false || $input === '') {
                $input = null;
            }

            array_shift($real_route_parts);
            \App\Api\ApiController::handleRequest($real_route_parts, $_GET, $_POST, $input);
            exit;
        }

        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

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
                            echo '<div class="d-flex flex-column align-content-center bg-danger text-black">';
                            var_dump('>>> ', $_POST);
                            echo '</div>';
                            $controller->store();
                            break;
                        case 'delete':
                            $controller->delete();
                            break;
                        case 'edit':
                            $controller->edit();
                            break;
                        case 'update':
                            $controller->update();
                            break;
                    }
                } else {
                    $controller->index();
                }

                break;
            case 'register':
                $controller = new AuthController();
                $controller->register();
                break;
            case 'login':
                $controller = new AuthController();
                $controller->login();
                break;
            case 'authenticate':
                $controller = new AuthController();
                $controller->authenticate();
                break;
            case 'logout':
                $controller = new AuthController();
                $controller->logout();
                break;
            case 'auth':
                $controller = new AuthController();

                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'store':
                            $controller->store();
                            break;
                        case 'authenticate':
                            $controller->authenticate();
                            break;
                        default;
                        break;
                    }
                } else {
                    $controller->login();
                }
                break;
            default:
                http_response_code(404);
                echo 'Page not Found';
                break;
        }
    }
}