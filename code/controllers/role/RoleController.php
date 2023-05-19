<?php

namespace controllers\role;
use models\role\Role;

require_once ROOT_DIR . '/app/models/role/Role.php';

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
        header('Location: index.php?page=roles');
    }

    public function delete(): void
    {
        $roleModel = new Role();
        $roleModel->deleteRole($_GET['id']);

        header('Location: index.php?page=roles');
    }

    public function edit($id): void
    {
        $roleModel = new Role();
        $role = $roleModel->getRoleById($id);

        if (!$role) {
            echo "Role not found";
            return;
        }

        include ROOT_DIR . "/app/view/role/edit.php";
    }

    public function update(): void
    {
        if (isset($_POST['id']) && isset($_POST['role_name']) && isset($_POST['role_description'])) {
            $id = trim($_POST['id']);
            $role_name = trim($_POST['role_name']);
            $role_description = trim($_POST['role_description']);

            if (empty($role_name)) {
                echo "Role name is required";
                return;
            }

            $roleModel = new Role();
            $roleModel->updateRole($id, $role_name, $role_description);
        }

        header('Location: index.php?page=roles');
    }
}