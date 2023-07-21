<?php

namespace App\Controllers\auth;
use App\Models\auth\AuthUser;
use App\Models\sessions\Sessions;
use App\Models\user\User;


class AuthController
{

    public function register(): void
    {
        require_once ROOT_DIR . '/templates/users/register.php';
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
                password_hash($password,PASSWORD_DEFAULT),
                $role,
            );
        }
        header('Location: /auth/login');
    }

    public function login(): void
    {
        require_once ROOT_DIR . '/templates/users/login.php';
    }

    public function authenticate(): void
    {
        $authModel = new AuthUser();

        if ($_POST['email'] !== null && $_POST['password'] !== null) {
            $email = $_POST['email'];
            $password = $_POST['password'];
//            $remember = $_POST['remember'] ?? '';

            $user = $authModel->findByEmail($email);
            var_dump($_POST);
            echo '<br />';
            var_dump('USER : ',$user);
            echo '<br />';
            echo '<br />';
            echo '<br />';
//            if(!$user){
//                header('Location: /auth/login');
//            }

            if (password_verify($_POST['password'],$user['password']) ) {
//            var_dump('USER ------- > ', $user);
//            echo '<br />';
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                if ($remember === 'on') {
                    setcookie('user_email', $email, time() + (7 * 24 * 60 * 60), "/");
                    setcookie('user_password', $password, time() + (7 * 24 * 60 * 60), "/");
                }
                $userModel = new User();
                $userObj = $userModel->read($user['id']);
                $sessionModel = new Sessions();
                $sessionModel->create($user['id'], $userObj['username']);
                $sessionModel->setCookie();

                header('Location: /');
            } else {
                header('Location: /auth/login');
            }
        }
    }

    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /auth/login');
    }
}