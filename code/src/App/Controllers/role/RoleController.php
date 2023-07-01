<?php

namespace App\Controllers\role;
use App\Models\Check;
use App\Models\role\Role;


class RoleController
{
    private Check $check;

    public function __construct(){
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role']:null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
        $this->check->requirePermission();

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        require_once ROOT_DIR . '/templates/role/index.php';
    }

    public function create(): void
    {
        $this->check->requirePermission();

        require_once ROOT_DIR . '/templates/role/create.php';
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
        header('Location: /roles');
    }

    public function delete($params): void
    {
        $this->check->requirePermission();

        $roleModel = new Role();
        $roleModel->deleteRole($params['id']);

        header('Location: /roles');
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

        include ROOT_DIR . "/templates/role/edit.php";
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