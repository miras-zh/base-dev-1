<?php

//require_once '../../models/User.php';
require_once ROOT_DIR . '/app/models/AuthUser.php';

class AuthController
{

    public function register(): void
    {
        require_once ROOT_DIR . '/app/view/users/register.php';
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
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 1
            ];

            $userModel->create(
                $data['username'],
                $data['email'],
                $data['password'],
                $data['role'],
            );
        }
        header('Location: index.php?page=login');
    }

    public function login(): void
    {
        include ROOT_DIR . '/app/views/users/login.php';
    }

    public function authenticate(): void
    {
        $authModel = new AuthUser();

        if ($_POST['email'] !== null && $_POST['password'] !== null) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $authModel->findByEmail($email);
            if($user && password_verify($password, $user['password'])){
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: index.php');
            }else{
                echo 'INVALID';
            }
        }
    }

    public function logout(): void{
        session_start();
        session_unset();
        session_destroy();

        header('Location: index.php');
    }
}