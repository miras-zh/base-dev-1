<?php

namespace models;

class AuthUser
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (PDOException $error) {
            $this->createTable();
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

        $this->db->beginTransaction();
        try {
            $this->db->exec($roleTableQuery);
            $this->db->exec($userTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();
            return false;
        }
    }

    public function register($username, $email, $password): bool
    {
        $created_at = date('Y-m-d H:i:s');
        $query = "INSERT INTO users (username, email, password,created_at) VALUES (?,?,?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $created_at]);
            return true;
        } catch (PDOException $err) {
            return false;
        }
    }

    public function login($email, $password): bool
    {
        try {
            $query = "SELECT * FROM users WHERE email=? LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }

            return false;
        } catch (PDOException $err) {
            return false;
        }
    }

    public function findByEmail($email): bool|array
    {
        try {
            $query = "SELECT * FROM users WHERE email=? LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return is_array($user) ? $user : false;

        } catch (PDOException $err) {
            return false;
        }
    }
}


