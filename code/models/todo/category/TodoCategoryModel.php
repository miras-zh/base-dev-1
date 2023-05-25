<?php
namespace models\todo\category;

use models\Database;
use PDO;
use PDOException;

class TodoCategoryModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

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
        $query = "SELECT * FROM `todo_category`";

        try {
            $stmnt = $this->db->query("SELECT * FROM `todo_category`");
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
        $query = "INSERT INTO todo_category (title,description, user) VALUES (?,?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute([$title, $description, $user_id]);

            return true;
        } catch (PDOException $e) {

            var_dump('error->', $e);
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


