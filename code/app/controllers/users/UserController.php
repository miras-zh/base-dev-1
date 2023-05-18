<?php
require_once ROOT_DIR . '/app/models/User.php';
require_once ROOT_DIR . '/app/models/role/Role.php';

class UserController
{

    public function index(): void
    {
        $userModel = new User();
        $users = $userModel->readAll();
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();
        require_once ROOT_DIR . '/app/view/users/index.php';
    }

    public function create(): void
    {
        require_once ROOT_DIR . '/app/view/users/create.php';
    }

    public function store(): void
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            var_dump($_POST);
            if ($password !== $confirm_password) {
                echo "password do not match";
                return;
            }

            $userModel = new User();
            $config = require_once ROOT_DIR . '/config.php';
            $data=[
                'username'=> $_POST['username'],
                'email'=> $_POST['email'],
                'password'=> password_hash($password, PASSWORD_DEFAULT),
                'role'=>$config['start_role']
            ];

            $userModel->create(
                $data['username'],
                $data['email'],
                $data['password'],
                $data['role'],
            );
        }
        header('Location: index.php?page=users');
    }

    public function delete(): void
    {
        $userModel = new User();
        $userModel->delete($_GET['id']);

        header('Location: index.php?page=users');
    }

    public function edit(): void
    {
        $userModel = new User();
        $userModel->read($_GET['id']);
        $user = $userModel->read($_GET['id']);

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        include ROOT_DIR . "/app/view/users/edit.php";
//        header('Location: index.php?page=users');
    }

    public function update(): void
    {
        echo "test update";
        $userModel = new User();
        $userModel->update($_GET['id'], $_POST);

        header('Location: index.php?page=users');
    }
}