<?php

namespace App\Models\workers;

use App\Models\Database;
use PDO;
use PDOException;

class Workers
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $this->db->prepare("SELECT 1 FROM `workers` LIMIT 1")->execute();
        } catch (PDOException $err) {
            $this->createTable();
        } catch (\Throwable $throwable) {
            echo get_class($throwable), "<br>";
            exit($throwable);
        }
    }

    public function createTable(): bool
    {
        $workerTableQuery = "CREATE TABLE IF NOT EXISTS `workers` (
             `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
             `firstname` VARCHAR(255), 
             `lastname` VARCHAR(255) , 
             `fullname` VARCHAR(255), 
             `year_of_birth` VARCHAR(255), 
             `path_employment_contract` VARCHAR(255), 
             `path_biography` VARCHAR(255), 
             `job_title` INT(11) DEFAULT 0, 
             `phone` VARCHAR(255), 
             `phone_first` VARCHAR(255), 
             `phone_second` VARCHAR(255), 
             `address` VARCHAR(255), 
             `email` VARCHAR(255))";
        var_dump($workerTableQuery);

        $this->db->beginTransaction();
        try {
            $this->db->exec($workerTableQuery);
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
//            $stmnt = $this->db->query("SELECT * FROM `workers` ORDER BY lastname ASC");
            $stmnt = $this->db->query("SELECT * FROM `workers`");
            $workers = [];

            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $workers[] = $row;
            }
            return $workers;
        } catch (PDOException $err) {
            return false;
        }
    }

    public function create(
        $firstname,
        $lastname,
        $surname,
        $phone,
        $email,
    ): bool
    {
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO workers (firstname, lastname, surname, phone, email) VALUES (?,?,?,?,?)";
        var_dump($query);

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$firstname, $lastname, $surname, $phone, $email]);
            return true;
        } catch (PDOException $error) {
            exit($error);
            return false;
        }
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM workers WHERE id= ?";

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
        $query = "DELETE FROM workers WHERE id= ?";
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
        $query = "SELECT * FROM workers WHERE id= ?";

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
        $query = "UPDATE workers SET username=?,email=?, role=?, is_admin=? WHERE id=?";

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






