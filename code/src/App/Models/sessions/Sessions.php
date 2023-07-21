<?php

namespace App\Models\sessions;

use App\Models\Database;
use PDO;
use PDOException;
use src\App;

class Sessions
{
    private PDO $db;
    protected string $secret_code;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->secret_code = App::getRandomString(32,'01213456789abcdef');
        try {
            $this->db->prepare("SELECT 1 FROM `sessions` LIMIT 1")->execute();
        } catch (PDOException $err) {
            $this->createTable();
        } catch (\Throwable $throwable) {
            echo get_class($throwable), "<br>";
            exit($throwable);
        }
    }

    public function createTable(): bool
    {
        $sessionsTableQuery = "CREATE TABLE IF NOT EXISTS `sessions` (
            `id` INT(11) NOT NULL PRIMARY KEY ,
            `secret_code` BINARY(32) NOT NULL,
            `authorization_id` INT(1),
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

        $this->db->beginTransaction();
        try {
            $this->db->exec($sessionsTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();

            return false;
        }
    }


    public function readAll(): bool|array
    {
        try {
            $stmnt = $this->db->query("SELECT * FROM `sessions`");
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
        int $authorization_id,
        string $user_name
    ): self
    {
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO sessions ( secret_code, authorization_id,user_name, created_at) VALUES (?,?,?,?)";
           $stmt = $this->db->prepare($query);
            $stmt->execute([$this->secret_code, $authorization_id,$user_name, $created_at]);
            return $this;
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM sessions WHERE id= ?";

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
        $query = "DELETE FROM sessions WHERE id= ?";
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
        $query = "SELECT * FROM sessions WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $error) {
            return false;
        }

    }

    public function setCookie(): void
    {
            setcookie('session_id', $this->secret_code, time() + (7 * 24 * 60 * 60), "/");
    }
}






