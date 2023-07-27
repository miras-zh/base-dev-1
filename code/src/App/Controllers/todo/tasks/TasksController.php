<?php

namespace App\Controllers\todo\tasks;

use Exception;
use App\Models\Check;
use App\Models\todo\category\TodoCategoryModel;
use App\Models\todo\tasks\TasksModel;
use App\Models\todo\tasks\TagsModel;


class TasksController
{
    private Check $check;
    private $tagsModel;

    public function __construct()
    {
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new Check($userRole);
        $this->tagsModel = new TagsModel();
    }

    public function index(): void
    {
        $this->check->requirePermission();

        $tasksModel = new TasksModel();
        $tasks = $tasksModel->getAllTasks();
        require_once ROOT_DIR . '/templates/todo/tasks/index.php';
    }

    public function create(): void
    {
        $this->check->requirePermission();

        $categoryModel = new TodoCategoryModel();
        $categories = $categoryModel->getAllCategoriesUsability();
        require_once ROOT_DIR . '/templates/todo/tasks/create.php';
    }

    public function kanban():void{
        $this->check->requirePermission();
        require_once ROOT_DIR . '/templates/todo/tasks/kanban.php';
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
        var_dump('****-',$tags);
        echo '<br/>';
        if (!$task) {
            echo "Task not found";
            return;
        }

        include ROOT_DIR . "/templates/todo/tasks/edit.php";
    }

    /**
     * @throws Exception
     */
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
            $finish_date = $_POST['finish_date'] ?? '';
            $reminder_at = $_POST['reminder_at'] ?? '';
            $category_id = isset($_POST['category_id']) ? trim($_POST['category_id']) : 1;

            $finish_date = new \DateTime($finish_date);
            $interval='';
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

            $reminder_at = $finish_date->sub($interval);
            $finish_date = $finish_date->format('Y-m-d H:i:s');
            $reminder_at=$reminder_at->format('Y-m-d H:i:s');

            if (empty($title)) {
                echo "title is required";
                return;
            }

            $taskModel = new TasksModel();
            $taskModel->updateTask($id, $title, $description, $status,$priority,$category_id,$finish_date,$reminder_at);

            //обработка тегов
            $tags = explode(',', $_POST['tags']);
            $tags = array_map('trim', $tags);

            //получение тегов с базы по задаче редактируемой
            $tagsModel = new TagsModel();
            $oldTags = $tagsModel->getTagsByTaskId($params['id']);

            //удаление старых связей между тегами
            $tagsModel->removeAllTagsByTaskId($params['id']);

            $user_id = $_SESSION['user_id'] ?? 0;

            //дбавляем новые теги и связываем  с задачей
            foreach ($tags as $tag_name){
                $tag=$tagsModel->getTagByNameAndUserId($tag_name,$user_id);
                if(!$tag){
                    $tag_id = $tagsModel->addTag($tag_name, $user_id);
                }else{
                    $tag_id = $tag['id'];
                }
                $tagsModel->addTaskTag($id, $tag_id);
            }

            //удаляем не используемые теги
            foreach ($oldTags as $oldTag){
                $tagsModel->removeUnUsedTags($oldTag['id']);
            }
        }

        header('Location: /todo/tasks');
    }
}