<?php

namespace models\company;

use models\Database;

class Company
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `companies` LIMIT 1");
        } catch (PDOException $error) {
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
        $companyTableQuery = "CREATE TABLE IF NOT EXISTS `companies` (
             `id` INT(11) NOT NULL AUTO_INCREMENT,
             `company_name` VARCHAR(255) NOT NULL, 
             `company_bin` VARCHAR(255) NOT NULL, 
             `region` VARCHAR(255) NOT NULL, 
             `address` VARCHAR(255) NOT NULL, 
             `otrasl` VARCHAR(255) NOT NULL, 
             `phone` VARCHAR(255) NOT NULL, 
             `email` VARCHAR(255) NOT NULL, 
             `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

        var_dump($companyTableQuery);
        exit();
        $this->db->beginTransaction();
        try {
            $this->db->exec($companyTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getAllCompanies()
    {
        $query = "SELECT * FROM `companies`";

        try {
            $stmnt = $this->db->query("SELECT * FROM `companies`");
            $companies = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $companies[] = $row;
            }

            return $companies;
        } catch (PDOException $e) {

        }
    }

    public function getCompanyById($id): bool|array
    {
        $query = "SELECT * FROM companies WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $company = $stmt->fetch(PDO::FETCH_ASSOC);

            return $company;

        } catch (PDOException $err) {
            return false;
        }
    }

    public function createCompany($company_name, $company_bin, $region, $address, $otrasl, $phone, $email)
    {
        $query = "INSERT INTO companies (company_name,company_bin,region, address,otrasl,phone,email) VALUES (?,?,?,?,?,?,?)";

        echo '<br/>';
        echo '<div class="container bg-info text-black">';
        var_dump($company_name, ' - ', $company_bin, ' - ', $region, ' - ', $address, ' - ', $otrasl, ' - ', $phone, ' - ', $email);
        echo '</div>';
        echo '<br/>';
        echo '<br/>';


        try {
            $stmt = $this->db->prepare($query);
            var_dump($stmt);
            $res = $stmt->execute([$company_name, $company_bin, $region, $address, $otrasl, $phone, $email]);

            return true;
        } catch (PDOException $e) {
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            var_dump('error->', $e);
        }
    }

    public function updateCompany($id, $company_name, $company_description)
    {
        $query = "UPDATE companies SET company_name=?,company_description=? WHERE id=?";

        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$company_name, $company_description, $id]);
            return true;
        } catch (PDOException $e) {

        }
    }

    public function deleteCompany($id): bool
    {
        $query = "DELETE FROM companies WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }
}


