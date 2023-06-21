<?php
namespace models\todo\tasks;

use models\Database;
use PDO;
use PDOException;

class TasksModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `tasks` LIMIT 1");
        } catch (PDOException $error) {
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
        $tasksTableQuery = "CREATE TABLE IF NOT EXISTS `tasks` (
            `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `category_id` INT NOT NULL ,
            `status` ENUM('new','in_progress','completed','on_hold','canceled') NOT NULL ,
            `priority` ENUM('low','medium','high','urgent') NOT NULL ,
            `assigned_to` INT,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `finish_date` DATETIME,
            `completed_at` DATETIME,
            `reminder_at` DATETIME,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE, 
            FOREIGN KEY (category_id) REFERENCES todo_category(id) ON DELETE SET NULL, 
            FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL )";

        $this->db->beginTransaction();
        try {
            $this->db->exec($tasksTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getAllTasks(): array
    {
        $stmnt = $this->db->query("SELECT * FROM `tasks`");
        $tasks = [];
        while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $row;
        }

        return $tasks;
    }

    public function getTasksById($id): bool|array
    {
        $query = "SELECT * FROM tasks WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);

            return $task;

        } catch (PDOException $err) {
            return false;
        }
    }

    public function createTask($title, $description, $user_id)
    {
        $category_id = 1;
        var_dump('model create task', $user_id);
        echo '<br />';
        var_dump('model create title:', $title);
        echo '<br />';
        var_dump('model create description', $description);
        echo '<br />';
        echo '<br />';
        echo '<br />';
        $query = "INSERT INTO tasks (title,description, user_id, category_id,status,priority) VALUES (?,?,?,?,?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute([$title, $description, $user_id,$category_id,'new','low']);
            var_dump('res', $res);
            echo '<br />';
            return true;
        } catch (PDOException $e) {

            var_dump('error->', $e);
        exit();
        }
    }

    public function updateTask($id, $title, $description, $status, $priority,$category_id,$finish_date,$reminder_at)
    {
        $query = "UPDATE tasks SET title=?,description=?,status=?, priority=?, category_id=?,finish_date=?,reminder_at=? WHERE id=?";


        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$title, $description, $status,$priority,$category_id,$finish_date, $reminder_at,$id]);
            return true;
        } catch (PDOException $e) {
            var_dump($e);
            exit();
        }
    }

    public function deleteTask($id): bool
    {
        $query = "DELETE FROM tasks WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }
}


