<?php

namespace App\Models\user;

use App\Models\Database;
use PDO;
use PDOException;

class User
{


    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $this->db->prepare("SELECT 1 FROM `users` LIMIT 1")->execute();
        } catch (PDOException $err) {
            $this->createTable();
        } catch (\Throwable $throwable) {
            echo get_class($throwable), "<br>";
            exit($throwable);
        }
    }

    public function createTable(): bool
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `roles` (
            `id` INT(11) NOT NULL PRIMARY KEY ,
            `role_name` VARCHAR(255) NOT NULL,
            `role_description` TEXT)";
        $userTableQuery = "CREATE TABLE IF NOT EXISTS `users` (
             `id` INT(11) NOT NULL AUTO_INCREMENT,
             `username` VARCHAR(255) NOT NULL, 
             `email` VARCHAR(255) NOT NULL, 
             `email_verification` TINYINT(1) NOT NULL DEFAULT 0, 
             `password` VARCHAR(255) NOT NULL,
             `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
             `role` INT(11) NOT NULL DEFAULT 0,
             `is_active` TINYINT(1) NOT NULL DEFAULT 1,
             `last_login` TIMESTAMP NULL,
             `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
             PRIMARY KEY (`id`),
             FOREIGN KEY (`role`) REFERENCES `roles`(`id`) )";
        var_dump($userTableQuery);

        $this->db->beginTransaction();
        try {
            $this->db->exec($roleTableQuery);
            $this->db->exec($userTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();
            var_dump($err);
            exit();
            return false;
        }
    }

    public function index()
    {

    }

    public function readAll(): bool|array
    {
        try {
            $stmnt = $this->db->query("SELECT * FROM `users`");
            $users = [];

            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
            return $users;
        } catch (PDOException $err) {
            return false;
        }
    }

    public function create(
        string $username,
        string $email,
        string $password,
        int    $role,
    ): bool
    {
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (username, email, password, role, created_at) VALUES (?,?,?,?,?)";
        var_dump($query);

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, $password, $role, $created_at]);
            return true;
        } catch (PDOException $error) {
            exit($error);
            return false;
        }
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM users WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function edit($id)
    {
        $query = "DELETE FROM users WHERE id= ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM users WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $error) {
            return false;
        }

    }

    public function update($id, $data): bool
    {
        $username = $data['username'];
        $admin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;
        $email = $data['email'];
        $role = $data['role'];
        $is_active = isset($data['is_active']) ? 1 : 0;
        $query = "UPDATE users SET username=?,email=?, role=?, is_admin=? WHERE id=?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, $role, $admin, $id]);
            return true;
        } catch (PDOException $error) {
            exit($error);
            return false;
        }
    }
}






