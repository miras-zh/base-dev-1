<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require '../vendor/autoload.php';
$loader->addPsr4('App\\', 'src');

$method = $_SERVER['REQUEST_METHOD'];
//switch($method) {
//    case 'POST':
//        $user = json_decode(file_get_contents('php://input'));
//        $date = date('Y-m-d');
//        echo json_encode($data);
//        break;
//}


const ROOT_DIR = __DIR__;

require_once ROOT_DIR . '/app/models/Database.php';
$db = Database::getInstance();
require_once 'app/controllers/users/AuthController.php';
require_once ROOT_DIR . '/app/controllers/HomeController.php';
require_once 'app/controllers/users/UserController.php';
require_once 'app/controllers/role/RoleController.php';
require_once 'app/controllers/company/CompanyController.php';
require_once 'app/controllers/pages/PagesController.php';
require_once 'app/models/User.php';
require_once 'app/models/AuthUser.php';
require_once 'app/router.php';
require_once 'app/models/role/Role.php';
require_once 'app/models/company/Company.php';
require_once 'app/models/pages/Pages.php';

$router = new Router();
$router->run();

