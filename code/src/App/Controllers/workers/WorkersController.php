<?php

namespace App\Controllers\workers;
use App\Models\Check;
use App\Models\role\Role;
use App\Models\user\User;
use App\Models\workers\Workers;


class WorkersController
{   private Check $check;

    public function __construct(){
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role']:null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
        $workersModel = new Workers();
        $workers = $workersModel->readAll();

        require_once ROOT_DIR . '/templates/workers/index.php';
    }

    public function create(): void
    {
        require_once ROOT_DIR . '/templates/workers/create.php';
    }

    public function store(): void
    {
        if (isset($_POST['firstname']) && isset($_POST['lastname'])) {

            $workersModel = new Workers();
            $config = require_once ROOT_DIR . '/config.php';
            $data = [
                'firstname' => $_POST['firstname'] ?? '',
                'lastname' => $_POST['lastname'] ?? '',
                'surname' => $_POST['surname'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'email' => $_POST['email'] ?? '',
            ];

            $workersModel->create(
                $data['firstname'],
                $data['lastname'],
                $data['surname'],
                $data['phone'],
                $data['email'],
            );
        }
        header('Location: /workers');
    }

    public function delete($params): void
    {
        $userModel = new User();
        $userModel->delete($params['id']);

        header('Location: /workers');
    }

    public function edit($params): void
    {
        $userModel = new User();
        $user = $userModel->read($params['id']);

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        include ROOT_DIR . "/templates/workers/edit.php";
    }

    public function update($params): void
    {
        if(isset($_POST['role'])){
            $newRole = $_POST['role'];
            if($this->check->isCurrentUserRole($newRole)){
                header('Location: /login');
                exit();
            }
        }

        $userModel = new User();
        $userModel->update($params['id'], $_POST);

        header('Location: /workers');
    }

    public function getAllUsers(): bool|array
    {
        $userModel = new User();
        return $userModel->readAll();
    }
}