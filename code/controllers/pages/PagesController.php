<?php

namespace controllers\pages;
use models\pages\Pages;
use models\role\Role;
use models\Check;

require_once ROOT_DIR . '/models/pages/Pages.php';

class PagesController
{
    private $check;

    public function __construct(){
        $this->check = new Check();
    }

    public function index(): void
    {
        $slug = $this->check->getCurrentUrlSlug();
//        var_dump($_SESSION);
//        exit();
        if(!$this->checkPermission($slug)){
            header("Location: /");
            return;
        }

        $pagesModel = new Pages();
        $pages = $pagesModel->getAllPages();

        require_once ROOT_DIR . '/app/view/pages/index.php';
    }

    public function create(): void
    {
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();
        require_once ROOT_DIR . '/app/view/pages/create.php';
    }

    public function store(): void
    {
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
        $pageModel = new Pages();
        $pageModel->deletePage($params['id']);

        header('Location: /pages');
    }

    public function edit($params): void
    {
        $pageModel = new Pages();
        $page = $pageModel->getPageById($params['id']);

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        if (!$page) {
            echo "Page not found";
            return;
        }

        include ROOT_DIR . "/app/view/pages/edit.php";
    }

    public function update($params): void
    {
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

    public function checkPermission($slug){
        $pageModel = new Pages();
        $page = $pageModel->findBySlug($slug);

        if(!$page){
            return false;
        }

        $allowedRoles = explode(',',$page['role']);

        if(isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], $allowedRoles)){
            return true;
        }else{
            return false;
        }
    }
}