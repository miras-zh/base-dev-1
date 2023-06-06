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

        if (isset($_POST['title']) && isset($_POST['description'])) {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $user_id = $_SESSION['user_id'] ?? 0;

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
        $resTags = $tagsModel->getTagsByTaskId($task['id']);
        $tags = $resTags !== false ? $resTags : [];
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
            var_dump('$post>', $_POST);
            echo '</br>';
            $id = trim($params['id']);
            $title = trim($_POST['title']);
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $status = isset($_POST['status']) ? trim($_POST['status']) : 'new';
            $priority = isset($_POST['priority']) ? trim($_POST['priority']) : 'low';
            $finish_date = isset($_POST['finish_date']) ? $_POST['finish_date'] : '';
            $reminder_at = isset($_POST['reminder_at']) ? $_POST['reminder_at'] : '';
            $category_id = isset($_POST['category_id']) ? trim($_POST['category_id']) : 1;

            var_dump('$finish_date',$finish_date);
            echo '<br>';
            var_dump('$reminder_at',$reminder_at);
            echo '<br>';


            $finish_date = new \DateTime($finish_date);


            $interval;
            switch ($reminder_at){
                case '30_min';
                    $interval = new \DateInterval('PT30M');
                    break;
                case '60_min';
                    $interval = new \DateInterval('PT1H');
                    break;
                case '120_min';
                    $interval = new \DateInterval('PT2H');
                    break;
                case '12_h';
                    $interval = new \DateInterval('PT12H');
                    break;
                case '24_h';
                    $interval = new \DateInterval('P1D');
                    break;
                case '7_days';
                    $interval = new \DateInterval('P7D');
                    break;
            }
            var_dump('$interval>',$interval);
            echo '</br>';
            var_dump('$reminder_at >',$reminder_at );
            echo '</br>';

            $reminder_at = $finish_date->sub($interval);

            $finish_date = $finish_date->format('Y-m-d H:i:s');
            $reminder_at=$reminder_at->format('Y-m-d H:i:s');

            if (empty($title)) {
                echo "title is required";
                return;
            }

            $taskModel = new TasksModel();



            $taskModel->updateTask($id, $title, $description, $status,$priority,$category_id,$finish_date,$reminder_at);
        }

        header('Location: /todo/tasks');
    }
}