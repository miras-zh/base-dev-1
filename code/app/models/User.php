<?php

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

    public function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `login` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     )";

        try {
            $stmnt = $this->db->query($query);
            $stmnt->execute();
            return true;
        } catch (PDOException $err) {
            return false;
        }
    }

    public function index()
    {

    }

    public function readAll()
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

    public function create($data): bool
    {
        $login = $data['login'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $admin = $data['admin'] !== 0 && !empty($data['admin']) ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (login, password, is_admin, created_at) VALUE (?,?,?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $password, $admin, $created_at]);
            return true;
        } catch (PDOException $error) {
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

    public function update($id, $data)
    {
        $login = $data['login'];
        $admin = $data['admin'] !== 0 && !empty($data['admin']) ? 1 : 0;

        $query = "UPDATE users SET login=?, is_admin=? WHERE id=?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $admin, $id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }
}






