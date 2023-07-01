<?php

namespace App\Models\pages;

use App\Models\Database;
use App\Models\role\Role;
use PDO;
use PDOException;

class Pages
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `pages` LIMIT 1");
        } catch (PDOException $error) {
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `pages` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NOT NULL,
            `role` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)
            ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $this->db->beginTransaction();
        try {
            $this->db->exec($roleTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getAllPages()
    {
        $query = "SELECT * FROM `pages`";

        try {
            $stmnt = $this->db->query("SELECT * FROM `pages`");
            $pages = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $pages[] = $row;
            }

            return $pages;
        } catch (PDOException $e) {

        }
    }

    public function getPageById($id): bool|array
    {
        $query = "SELECT * FROM pages WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $page = $stmt->fetch(PDO::FETCH_ASSOC);

            return $page;

        } catch (PDOException $err) {
            return false;
        }
    }

    public function findBySlug($slug): bool|array
    {
        $query = "SELECT * FROM pages WHERE slug=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$slug]);
            $page = $stmt->fetch(PDO::FETCH_ASSOC);

            return $page;

        } catch (PDOException $err) {
            return false;
        }
    }

    public function createPage($title, $slug, $roles)
    {
        $query = "INSERT INTO pages (title,slug, role) VALUES (?,?,?)";
        try {
            $stmt = $this->db->prepare($query);
            var_dump($stmt);
            $res = $stmt->execute([$title, $slug, $roles]);
            var_dump('->', $res);

            return true;
        } catch (PDOException $e) {

            var_dump('error->', $e);
        }
    }

    public function updatePage($id, $title, $slug, $roles)
    {
        $query = "UPDATE pages SET title=?,slug=?, role=? WHERE id=?";

        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$title, $slug, $roles, $id]);
            return true;
        } catch (PDOException $e) {

        }
    }

    public function deletePage($id): bool
    {
        $query = "DELETE FROM pages WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }
}


