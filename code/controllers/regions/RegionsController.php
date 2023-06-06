<?php

namespace controllers\regions;
use models\Check;
use models\regions\RegionsModel;
use models\role\Role;

require_once ROOT_DIR . '/models/regions/RegionsModel.php';

class RegionsController
{
    private Check $check;

    public function __construct(){
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
//        $this->check->requirePermission();

        $regionModel = new RegionsModel();
        $regions = $regionModel->getAllRegion();

        require_once ROOT_DIR . '/app/view/regions/index.php';
    }

    public function create(): void
    {
//        $this->check->requirePermission();

        require_once ROOT_DIR . '/app/view/regions/create.php';
    }

    public function store(): void
    {
//        $this->check->requirePermission();
        if (isset($_POST['region_name']) && isset($_POST['region_description'])) {
var_dump($_POST);
echo '<br>';
echo '<br>';
var_dump($_POST);
echo '<br>';
            $region_name = trim($_POST['region_name']);
            $region_description = trim($_POST['region_description']);

            if (empty($region_name)) {
                echo "Region name is required";
                return;
            }

            $regionsModel = new RegionsModel();
            $regionsModel->createRegion(
                $region_name,
                $region_description
            );
        }
        header('Location: /regions');
    }

    public function delete($params): void
    {
//        $this->check->requirePermission();

        $regionsModel = new RegionsModel();
        $regionsModel->deleteRegion($params['id']);

        header('Location: /regions');
    }

    public function edit($params): void
    {
//        $this->check->requirePermission();

        $regionsModel = new RegionsModel();
        $region = $regionsModel->getRegionById($params['id']);

        if (!$region) {
            echo "Region not found";
            return;
        }

        include ROOT_DIR . "/app/view/regions/edit.php";
    }

    public function update($params): void
    {
//        $this->check->requirePermission();
        var_dump($params);
        if (isset($params['id']) && isset($_POST['region_name']) && isset($_POST['region_description'])) {
            $id = trim($params['id']);
            $region_name = trim($_POST['region_name']);
            $region_description = trim($_POST['region_description']);

            if (empty($region_name)) {
                echo "Region name is required";
                return;
            }

            $regionsModel = new RegionsModel();
            $regionsModel->updateRegion($id, $region_name, $region_description);
        }

        header('Location: /regions');
    }
}