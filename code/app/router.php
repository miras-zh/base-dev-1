<?php

class Router
{
    public function run()
    {

//        $page = preg_replace('|\?.*?$|', '', $_SERVER['REQUEST_URI']);
//        echo $page;
//        $page = trim($page, '/');
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