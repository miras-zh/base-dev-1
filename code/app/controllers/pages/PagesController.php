<?php
require_once ROOT_DIR . '/app/models/pages/Pages.php';

class PagesController{

    public function index(): void
    {
        $pagesModel = new Pages();
        $roles = $pagesModel->getAllPages();

        require_once ROOT_DIR . '/app/view/pages/index.php';
    }

    public function create(): void
    {
        //вызываем шабблон страницы
        require_once ROOT_DIR . '/app/view/pages/create.php';
    }

    public function store(): void
    {
        if (isset($_POST['title']) && isset($_POST['slug'])) {
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);

            if (empty($title) && empty($title)) {
                echo "title is required";
                return;
            }

            $pageModel = new Pages();
            $pageModel->createPage(
                $title,
                $slug
            );
        }
        header('Location: index.php?page=pages');
    }

    public function delete(): void
    {
        $pageModel = new Pages();
        $pageModel->deletePage($_GET['id']);

        header('Location: index.php?page=roles');
    }

    public function edit($id): void
    {
        $pageModel = new Pages();
        $page = $pageModel->getPageById($id);

        if (!$page) {
            echo "Page not found";
            return;
        }

        include ROOT_DIR . "/app/view/pages/edit.php";
    }

    public function update(): void
    {
        if (isset($_POST['id']) && isset($_POST['role_name']) && isset($_POST['role_description'])) {
            $id = trim($_POST['id']);
            $role_name = trim($_POST['role_name']);
            $role_description = trim($_POST['role_description']);

            if (empty($role_name)) {
                echo "Role name is required";
                return;
            }

            $roleModel = new Role();
            $roleModel->updateRole($id, $role_name, $role_description);
        }

        header('Location: index.php?page=roles');
    }
}