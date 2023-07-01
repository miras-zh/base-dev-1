<?php

namespace App\Controllers\todo\category;

use App\Models\Check;
use App\Models\todo\category\TodoCategoryModel;


class TodoCategoryController
{
    private Check $check;

    public function __construct()
    {
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
        $this->check->requirePermission();

        $todoCategoryModel = new TodoCategoryModel();
        $categories = $todoCategoryModel->getAllCategories();

        require_once ROOT_DIR . '/templates/todo/category/index.php';
    }

    public function create(): void
    {
        $this->check->requirePermission();

        require_once ROOT_DIR . '/templates/todo/category/create.php';
    }

    public function store(): void
    {
        $this->check->requirePermission();
        var_dump('store category',$_POST);
            echo '<br />';

        if (isset($_POST['title']) && isset($_POST['description'])) {
        var_dump('check:: store category', $_POST);
            echo '<br />';
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $user_id = $_SESSION['user_id'] ?? 0;
        var_dump('user', $user_id);
            echo '<br />';

            if (empty($title)) {
                echo "Category title is required";
                return;
            }


            $todoCategoryModel = new TodoCategoryModel();
            $todoCategoryModel->createCategory(
                $title,
                $description,
                $user_id
            );
        }
        header('Location: /todo/category');
    }

    public function delete($params): void
    {
        $this->check->requirePermission();

        $todoCategoryModel = new TodoCategoryModel();
        $todoCategoryModel->deleteCategory($params['id']);

        header('Location: /todo/category');
    }

    public function edit($params): void
    {
        $this->check->requirePermission();

        $todoCategoryModel = new TodoCategoryModel();
        $category = $todoCategoryModel->getCategoryById($params['id']);

        if (!$category) {
            echo "Category not found";
            return;
        }

        include ROOT_DIR . "/templates/todo/category/edit.php";
    }

    public function update($params): void
    {
        $this->check->requirePermission();

        if (isset($params['id']) && isset($_POST['title'])) {
            $id = trim($params['id']);
            $title = trim($_POST['title']);
            $description = isset($_POST['description'])?trim($_POST['description']):'';
            $usability = isset($_POST['usability'])?trim($_POST['usability']):0;

            if (empty($title)) {
                echo "title is required";
                return;
            }

            $todoCategoryModel = new TodoCategoryModel();
            $todoCategoryModel->updateCategory($id, $title, $description, $usability);
        }

        header('Location: /todo/category');
    }
}