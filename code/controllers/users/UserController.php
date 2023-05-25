<?php

namespace controllers\users;
use models\Check;
use models\role\Role;
use models\user\User;

require_once ROOT_DIR . '/models/user/User.php';
require_once ROOT_DIR . '/models/role/Role.php';

class UserController
{   private Check $check;

    public function __construct(){
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role']:null;
        $this->check = new Check($userRole);
    }

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

            if ($password !== $confirm_password) {
                echo "password do not match";
                return;
            }

            $userModel = new User();
            $config = require_once ROOT_DIR . '/config.php';
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => START_ROLE
            ];

            $userModel->create(
                $data['username'],
                $data['email'],
                $data['password'],
                $data['role'],
            );
        }
        header('Location: /users');
    }

    public function delete($params): void
    {
        $userModel = new User();
        $userModel->delete($params['id']);

        header('Location: /users');
    }

    public function edit($params): void
    {
        $userModel = new User();
        $user = $userModel->read($params['id']);

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        include ROOT_DIR . "/app/view/users/edit.php";
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

        header('Location: /users');
    }

    public function getAllUsers(): bool|array
    {
        $userModel = new User();
        return $userModel->readAll();
    }
}