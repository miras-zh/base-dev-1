<?php


namespace controllers\home;
class HomeController
{

    public function __construct()
    {

    }

    public function index()
    {
        include ROOT_DIR . "/app/view/index.php";
    }
}