<?php


namespace App\Controllers\home;

use App\Models\Check;

class HomeController
{
    private Check $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->check->requirePermission();
            include ROOT_DIR . "/templates/index.php";
        }else{
            header("Location: /auth/login");
        }
    }
}