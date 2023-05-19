<?php

//require_once '../../models/User.php';
namespace controllers\auth;
use models\AuthUser;
use models\User;

require_once ROOT_DIR . '/app/models/AuthUser.php';

class AuthController
{

    public function register(): void
    {
        require_once ROOT_DIR . '/app/view/users/register.php';
    }

    public function index()
    {
    }

    public function store(): void
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);
            $email = trim($_POST['email']);
            $role = 1;
            if ($password !== $confirm_password) {
                echo "password do not match";
                return;
            }

            $userModel = new User();

            echo 'create!!!';
            $userModel->create(
                $username,
                $email,
                $password,
                $role,
            );
        }
        header('Location: index.php?page=login');
    }

    public function login(): void
    {
        require_once ROOT_DIR . '/app/view/users/login.php';
    }

    public function authenticate(): void
    {
        $authModel = new AuthUser();
        var_dump($_POST);


        if ($_POST['email'] !== null && $_POST['password'] !== null) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $remember = $_POST['remember'] ?? '';

            $user = $authModel->findByEmail($email);

            if ($user['password'] == $_POST['password']) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];

                if ($remember === 'on') {
                    setcookie('user_email', $email, time() + (7 * 24 * 60 * 60), "/");
                    setcookie('user_password', $password, time() + (7 * 24 * 60 * 60), "/");
                }

                header('Location: index.php');
            } else {
                echo 'INVALID';
            }
        }
    }

    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: index.php');
    }
}