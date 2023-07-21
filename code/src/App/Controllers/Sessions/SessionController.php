<?php

namespace App\Controllers\Sessions;


class SessionController
{

    public function __construct(){
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role']:null;
    }


    public function create(): void
    {
        var_dump($_SESSION);
        exit();
    }

}