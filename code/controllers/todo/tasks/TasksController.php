<?php

namespace controllers\todo\tasks;

use models\Check;
use models\todo\category\TodoCategoryModel;
use models\todo\tasks\TasksModel;
use models\todo\tasks\TagsModel;


class TasksController
{
    private Check $check;

    public function __construct()
    {
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
//        $this->check->requirePermission();

        $tasksModel = new TasksModel();
        $tasks = $tasksModel->getAllTasks();

        require_once ROOT_DIR . '/app/view/todo/tasks/index.php';
    }

    public function create(): void
    {
        $this->check->requirePermission();

        $categoryModel = new TodoCategoryModel();
        $categories = $categoryModel->getAllCategoriesUsability();
        require_once ROOT_DIR . '/app/view/todo/tasks/create.php';
    }

    public function store(): void
    {
        $this->check->requirePermission();
        var_dump('task create>', $_POST);
        echo '<br />';

        if (isset($_POST['title']) && isset($_POST['description'])) {
            var_dump('check:: store task', $_POST);
            echo '<br />';
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $user_id = $_SESSION['user_id'] ?? 0;
            var_dump('user', $user_id);
            echo '<br />';

            if (empty($title)) {
                echo "Task title is required";
                return;
            }


            $taskModel = new TasksModel();
            $taskModel->createTask(
                $title,
                $description,
                $user_id
            );
        }
        header('Location: /todo/tasks');
    }

    public function delete($params): void
    {
        $this->check->requirePermission();

        $tasksModel = new TasksModel();
        $tasksModel->deleteTask($params['id']);

        header('Location: /todo/tasks');
    }

    public function edit($params): void
    {
        $this->check->requirePermission();

        $taskModel = new TasksModel();
        $task = $taskModel->getTasksById($params['id']);

        $categoryModel = new TodoCategoryModel();
        $categories = $categoryModel->getAllCategoriesUsability();

        $tagsModel = new TagsModel();

        if (!$task) {
            echo "Task not found";
            return;
        }

        include ROOT_DIR . "/app/view/todo/tasks/edit.php";
    }

    public function update($params): void
    {
        $this->check->requirePermission();


        if (isset($params['id']) && isset($_POST['title'])) {
            $id = trim($params['id']);
            $title = trim($_POST['title']);
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $status = isset($_POST['status']) ? trim($_POST['status']) : 'new';
            $priority = isset($_POST['priority']) ? trim($_POST['priority']) : 'low';
            $category_id = isset($_POST['category_id']) ? trim($_POST['category_id']) : 1;

            if (empty($title)) {
                echo "title is required";
                return;
            }

            $taskModel = new TasksModel();
            $taskModel->updateTask($id, $title, $description, $status,$priority,$category_id);
        }

        header('Location: /todo/tasks');
    }
}