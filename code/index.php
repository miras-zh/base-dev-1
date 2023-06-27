<?php

use models\company\Company;

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

const ROOT_DIR = __DIR__;
require_once ROOT_DIR . '/models/Database.php';
require 'config.php';
require 'vendor/autoload.php';
require 'autoload.php';

if (!empty($argv)) {
    $client = new \GuzzleHttp\Client();
    $parser = new \Miko\UchetKz\Parser($client);
    $page = 1;
    $list = [];
    $base_company_file = fopen("base_company.txt", "w");

    do {
        while (true) {
            try {
                $organizations = $parser->searchOrganizations($page,'A');
                break;
            } catch (GuzzleHttp\Exception\GuzzleException $exception) {
                echo $exception, PHP_EOL;
                sleep(10);
            }
        }

//        print_r($organizations);
        foreach ($organizations as $organization) {
//            echo $organization->name, PHP_EOL;
            if ($organization->biin->bin !== null) {
                echo "\tBIN; {$organization->biin->getValue()}\n";
//                echo "\tType: {$organization->biin->bin->getType()->name}\n";
//                echo "\tSign: {$organization->biin->bin->getSign()->name}\n";
//                echo "\tAddress: {$organization->address}\n";
//                echo "\tBoss: {$organization->boss}\n";
                $companyModel = new Company();
                $companyFound = $companyModel->checkCompanyByBiin($organization->biin);
//var_dump($companyFound);exit;
                if(!$companyFound){
                    $companyModel->createCompany($organization->name,$organization->biin->getValue(),'Kazakhstan',$organization->address,'','','', $organization->boss);
                }
            } else {
//                echo "\tIIN: {$organization->biin->getValue()}\n";
//                echo "\tGender: ", ($organization->biin->iin->isMale() ? 'Male' : "Female"), PHP_EOL;
//                echo "\tAge: {$organization->biin->iin->getAge()}\n";
//                echo "\tAddress: {$organization->address}\n";
//                echo "\tBoss: {$organization->boss}\n";

                $companyModel = new Company();
                $companyFound = $companyModel->getCompanyByBin($organization->biin->iin->getValue());
//                var_dump('$companyFound>',$companyFound);
                if(!$companyFound){
                    $companyModel->createCompany($organization->name,$organization->biin->getValue(),'Kazakhstan',$organization->address,'','','', $organization->boss);
                }
            }

            fwrite($base_company_file, json_encode($organization));
        }
        $i++;
        var_dump('--------------------->',$i);
        sleep(2);
    } while ($page < $organizations->pages_total);

    fclose($base_company_file);
    exit;
}

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
