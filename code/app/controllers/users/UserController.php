<?php
//require_once '../../models/User.php';
require_once ROOT_DIR . '/app/models/User.php';

class UserController
{

    public function index(): void
    {
        $userModel = new User();
        $users = $userModel->readAll();
        require_once ROOT_DIR . '/app/view/users/index.php';
    }

    public function create(): void
    {
        //вызываем шабблон страницы
        require_once ROOT_DIR . '/app/view/users/create.php';
    }

    public function store(): void
    {
        if ($_POST['login'] && $_POST['password'] && $_POST['confirm_password']) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];


            if ($password !== $confirm_password) {
                echo "password do not match";
                return;
            }

            $userModel = new User();
            $users = $userModel->create($_POST);

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

        echo "<div class='container bg-info text-black'>";
        var_dump($_GET);
        echo "</div>";
        echo "<div class='container bg-primary text-black'>";
        var_dump($user);
        echo "</div>";


        include ROOT_DIR . "/app/view/users/edit.php";
//        header('Location: index.php?page=users');
    }

    public function update(): void
    {
        $userModel = new User();
        $userModel->update($_GET['id'], $_POST);

        header('Location: index.php?page=users');
    }
}