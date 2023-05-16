<?php

class Role {
    private PDO $db;

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

    public function getAllRoles(){
        $query = "SELECT * FROM `roles`";

        try {
            $stmnt = $this->db->prepare($query);
            $roles = $stmnt->fetchAll(PDO::FETCH_ASSOC);

            return $roles;
        }catch (PDOException $e){

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

    public function getRoleById($id): bool|array
    {
            $query = "SELECT * FROM users WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $role = $stmt->fetch(PDO::FETCH_ASSOC);

            return $role? $role : false;

        } catch (PDOException $err) {
            return false;
        }
    }

    public function createRole($role_name, $role_description){
        $query = "INSERT INTO roles (role_name,role_description) VALUES (?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$role_name, $role_description]);
            return true;
        }catch (PDOException $e){

        }
    }

    public function updateRole($id, $role_name, $role_description){
        $query = "UPDATE roles SET role_name=?,role_description=? WHERE id=?";

        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$role_name, $role_description]);
            return true;
        }catch (PDOException $e){

        }
    }
}


