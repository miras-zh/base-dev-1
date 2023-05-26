<?php

namespace models\regions;

use models\Database;
use PDO;
use PDOException;

class RegionsModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `roles` LIMIT 1");
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

    public function getAllRoles()
    {
        $query = "SELECT * FROM `roles`";

        try {
            $stmnt = $this->db->query("SELECT * FROM `roles`");
            $roles = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $roles[] = $row;
            }

            return $roles;
        } catch (PDOException $e) {

        }
    }

    public function getRoleById($id): bool|array
    {
        $query = "SELECT * FROM roles WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $role = $stmt->fetch(PDO::FETCH_ASSOC);

            return $role;

        } catch (PDOException $err) {
            return false;
        }
    }

    public function createRole($role_name, $role_description)
    {
        $query = "INSERT INTO roles (role_name,role_description) VALUES (?,?)";
        var_dump($role_name, ' - ', $role_description);
        var_dump($query);
        try {
            $stmt = $this->db->prepare($query);
            var_dump($stmt);
            $res = $stmt->execute([$role_name, $role_description]);
            echo '<br/>';
            var_dump('->', $res);

            return true;
        } catch (PDOException $e) {
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            var_dump('error->', $e);
        }
    }

    public function updateRole($id, $role_name, $role_description)
    {
        $query = "UPDATE roles SET role_name=?,role_description=? WHERE id=?";

        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$role_name, $role_description, $id]);
            return true;
        } catch (PDOException $e) {

        }
    }

    public function deleteRole($id): bool
    {
        $query = "DELETE FROM roles WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }
}


