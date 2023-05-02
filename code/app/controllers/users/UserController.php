<?php
//require_once '../../models/User.php';
require_once ROOT_DIR . '/app/models/User.php';
class UserController {

    public function index() {
        $userModel = new User();
        $users = $userModel->readAll();
        require_once ROOT_DIR . '/app/view/users/index.php';
    }

    public function create(){
        //вызываем шабблон страницы
        require_once ROOT_DIR . '/app/view/users/create.php';
    }

    public function store(){
        if($_POST['login'] && $_POST['password'] && $_POST['confirm_password'] && $_POST['admin']) {

            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];


            if($password !== $confirm_password){
                echo "password do not match";
                return;
            }

            $userModel = new User();
            $users = $userModel->create($_POST);

            echo '<div>';
            var_dump($_POST);
            echo '</div>';
        }
        header('Location: index.php?page=users');
    }
}