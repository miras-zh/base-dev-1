<?php

namespace controllers\role;
use models\role\Role;

require_once ROOT_DIR . '/models/role/Role.php';

class RoleController
{

    public function index(): void
    {
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        require_once ROOT_DIR . '/app/view/role/index.php';
    }

    public function create(): void
    {
        //вызываем шабблон страницы
        require_once ROOT_DIR . '/app/view/role/create.php';
    }

    public function store(): void
    {
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
        $roleModel = new Role();
        $roleModel->deleteRole($params['id']);

        header('Location: /roles');
    }

    public function edit($params): void
    {
        $roleModel = new Role();
        $role = $roleModel->getRoleById($params['id']);

        if (!$role) {
            echo "Role not found";
            return;
        }

        include ROOT_DIR . "/app/view/role/edit.php";
    }

    public function update($params): void
    {
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