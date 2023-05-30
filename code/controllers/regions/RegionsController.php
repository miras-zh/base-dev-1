<?php

namespace controllers\regions;
use models\Check;
use models\role\Role;

require_once ROOT_DIR . '/models/role/Role.php';

class RegionsController
{
    private Check $check;

    public function __construct(){
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
        $this->check->requirePermission();

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        require_once ROOT_DIR . '/app/view/regions/index.php';
    }

    public function create(): void
    {
        $this->check->requirePermission();

        require_once ROOT_DIR . '/app/view/regions/create.php';
    }

    public function store(): void
    {
        $this->check->requirePermission();

        if (isset($_POST['role_name']) && isset($_POST['role_description'])) {
            $role_name = trim($_POST['role_name']);
            $role_description = trim($_POST['role_description']);

            if (empty($role_name)) {
                echo "Role name is required";
                return;
            }

            $roleModel = new Role();
            $roleModel->createRole(
                $role_name,
                $role_description
            );
        }
        header('Location: /regions');
    }

    public function delete($params): void
    {
        $this->check->requirePermission();

        $roleModel = new Role();
        $roleModel->deleteRole($params['id']);

        header('Location: /regions');
    }

    public function edit($params): void
    {
        $this->check->requirePermission();

        $roleModel = new Role();
        $role = $roleModel->getRoleById($params['id']);

        if (!$role) {
            echo "Role not found";
            return;
        }

        include ROOT_DIR . "/app/view/regions/edit.php";
    }

    public function update($params): void
    {
        $this->check->requirePermission();
        var_dump($params);
        if (isset($params['id']) && isset($_POST['role_name']) && isset($_POST['role_description'])) {
            $id = trim($params['id']);
            $role_name = trim($_POST['role_name']);
            $role_description = trim($_POST['role_description']);

            if (empty($role_name)) {
                echo "Role name is required";
                return;
            }

            $roleModel = new Role();
            $roleModel->updateRole($id, $role_name, $role_description);
        }

        header('Location: /roles');
    }
}