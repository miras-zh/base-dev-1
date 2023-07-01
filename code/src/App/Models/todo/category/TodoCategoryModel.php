<?php

namespace App\Models\todo\category;

use App\Models\Database;
use PDO;
use PDOException;

class TodoCategoryModel
{
    private PDO $db;
    private mixed $userId;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->userId = $_SESSION['user_id'] ?? null;
        try {
            $result = $this->db->query("SELECT 1 FROM `todo_category` LIMIT 1");
        } catch (PDOException $error) {
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
        $todoCategoryTableQuery = "CREATE TABLE IF NOT EXISTS `todo_category` (
            `id` INT(11) NOT NULL PRIMARY KEY ,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `usability` TINYINT DEFAULT 1,
            `user` INT NOT NULL,
            FOREIGN KEY (user) REFERENCES users(id) ON DELETE CASCADE 
            )";

        $this->db->beginTransaction();
        try {
            $this->db->exec($todoCategoryTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM `todo_category` WHERE user=?";
        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$this->userId]);
            $categories = [];

            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row;
            }

            return $categories;
        } catch (PDOException $e) {
                var_dump('errrrorrrr>>>>', $e);
                exit();
        }
    }

    public function getAllCategoriesUsability()
    {
        $query = "SELECT * FROM `todo_category` WHERE user = ? AND usability = 1";

        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$this->userId]);
            $categories = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row;
            }

            return $categories;
        } catch (PDOException $e) {

        }
    }

    public function getCategoryById($id): bool|array
    {
        $query = "SELECT * FROM todo_category WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);

            return $category;

        } catch (PDOException $err) {
            return false;
        }
    }

    public function createCategory($title, $description, $user_id)
    {
        var_dump('model create category', $user_id);
        echo '<br />';
        $query = "INSERT INTO todo_category (title,description, user) VALUES (?,?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute([$title, $description, $user_id]);
            var_dump('res', $res);
            echo '<br />';
            return true;
        } catch (PDOException $e) {

            var_dump('error->', $e);
            exit();
        }
    }

    public function updateCategory($id, $title, $description, $usability)
    {
        $query = "UPDATE todo_category SET title=?,description=?,usability=? WHERE id=?";

        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$title, $description, $usability, $id]);
            return true;
        } catch (PDOException $e) {

        }
    }

    public function deleteCategory($id): bool
    {
        $query = "DELETE FROM todo_category WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }
}


