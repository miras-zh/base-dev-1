<?php

namespace App\Models\company;

use Kuvardin\KzIdentifiers\Biin;
use Kuvardin\KzIdentifiers\Bin;
use App\Models\Database;
use PDO;
use PDOException;
use Miko\UchetKz\Models\Organization as UchetOrganization;

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

    public function getCompanies(){
        $query = "SELECT * FROM `companies`";

        try {
            $stmnt = $this->db->query($query);
            $companies = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $companies[] = $row;
            }

            return $companies;
        } catch (PDOException $e) {

        }
    }

    public function getCompaniesNumber(): int
    {
        $query = "SELECT COUNT(*) FROM `companies`";
        $stmnt = $this->db->query($query);
        $row = $stmnt->fetch(PDO::FETCH_NUM);
        return $row[0];
    }

    public function getAllCompanies($page, $limit = null)
    {
        $limit ??= 30;
        $page ??= 1;
        if ($page < 1) {
            $page = 1;
        }

        $offset = $limit * ($page - 1);
        $query = "SELECT * FROM `companies` LIMIT $limit OFFSET $offset";



        try {
            $stmnt = $this->db->query($query);
            $companies = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $companies[] = $row;
            }

            return $companies;
        } catch (PDOException $e) {

        }
    }

    public function filter($name, $bin, $region, $page, $limit = null){

        $limit ??= 30;
        $page ??= 1;
        if ($page < 1) {
            $page = 1;
        }
        $offset = $limit * ($page - 1);
        try {
            $stmnt = $this->db->prepare("SELECT * FROM `companies` WHERE company_name LIKE ? AND company_bin LIKE ? AND region LIKE  ? LIMIT ? OFFSET  ?");
            $stmnt->execute(["%$name%", "%$bin%", "%$region%", "%$limit%", "%$offset%"]);
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

    public function runQuery(string $query){
        return $this->db->query($query);
    }

    public function createCompany($company_name, $company_bin, $region, $address, $otrasl, $phone, $email,$boss)
    {
        $query = "INSERT INTO companies (company_name,company_bin,region, address,otrasl,phone,email,boss) VALUES (?,?,?,?,?,?,?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute([$company_name, $company_bin, $region, $address, $otrasl, $phone, $email, $boss]);

            return true;
        } catch (PDOException $e) {
            var_dump('error->', $e);
            return false;
        }
    }

    public function createByUchetOrganization(UchetOrganization $organization)
    {
        // todo
    }

    public function updateByUchetOrganization(UchetOrganization $organization)
    {
        // todo
    }



    public function updateCompany($id, $company_name,$company_bin, $region, $address, $otrasl, $phone, $email)
    {
        $query = "UPDATE companies SET company_name=?,company_bin=?, region=?, address=?, otrasl=?, phone=? ,email=? WHERE id=?";
        echo '<br/>';
        try {
            $stmnt = $this->db->prepare($query);
            $res = $stmnt->execute([$company_name, $company_bin, $region, $address, $otrasl, $phone, $email, $id]);

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

    function checkCompanyByBiin(Biin $biin):bool
    {
        $query = "select COUNT(*) from companies where company_bin =? LIMIT 1";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$biin->getValue()]);
            $result = $stmt->fetch(PDO::FETCH_NUM);
            return (bool)$result[0];
        } catch (PDOException $error) {
            return false;
        }
    }

    function checkCompanyByBin($bin):bool
    {
        $query = "select COUNT(*) from companies where company_bin =? LIMIT 1";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$bin]);
            $result = $stmt->fetch(PDO::FETCH_NUM);
            return (bool)$result[0];
        } catch (PDOException $error) {
            return false;
        }
    }
}


