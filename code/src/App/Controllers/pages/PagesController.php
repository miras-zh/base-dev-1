<?php

namespace App\Controllers\pages;
use App\Models\pages\Pages;
use App\Models\role\Role;
use App\Models\Check;


class PagesController
{
    private Check $check;

    public function __construct(){
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role']:null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
        $this->check->requirePermission();

        $pagesModel = new Pages();
        $pages = $pagesModel->getAllPages();

        require_once ROOT_DIR . '/templates/pages/index.php';
    }

    public function create(): void
    {
        $this->check->requirePermission();

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();
        require_once ROOT_DIR . '/templates/pages/create.php';
    }

    public function store(): void{
        $this->check->requirePermission();

        if (isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])) {
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $roles = implode(",",$_POST['roles']);

            if (empty($title) && empty($title)) {
                echo "title is required";
                return;
            }

            $pageModel = new Pages();
            $pageModel->createPage(
                $title,
                $slug,
                $roles
            );
        }
        header('Location: /pages');
    }

    public function delete($params): void
    {
        $this->check->requirePermission();

        $pageModel = new Pages();
        $pageModel->deletePage($params['id']);

        header('Location: /pages');
    }

    public function edit($params): void
    {
        $this->check->requirePermission();

        $pageModel = new Pages();
        $page = $pageModel->getPageById($params['id']);

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        if (!$page) {
            echo "Page not found";
            return;
        }

        include ROOT_DIR . "/templates/pages/edit.php";
    }

    public function calendar(){
        include ROOT_DIR . "/templates/pages/calendar.php";
    }

    public function roadmap(){
        include ROOT_DIR . "/templates/pages/roadmap.php";
    }

    public function update($params): void
    {
        $this->check->requirePermission();

        if (isset($params['id']) && isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])) {
            $id = trim($_POST['id']);
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $roles = implode(",",$_POST['roles']);

            if (empty($title)) {
                echo "title is required";
                return;
            }

            $pageModel = new Pages();
            $page = $pageModel->updatePage($id, $title, $slug, $roles);
        }

        header('Location: /pages');
    }

}