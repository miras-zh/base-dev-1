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

    public function getCompanies()
    {
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

    public function getLimitCompanies($limit, $offset)
    {
        $query = "select * from companies limit $limit offset $offset";
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

    public function getLink($limit, $offset): array|bool
    {
        $query = "select * from links limit $limit offset $offset";
        try {
            $stmnt = $this->db->query($query);
            $links = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $links[] = $row;
            }

            return $links;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function filter(string $name = null, string $bin = null, string $region = null, int $page = 1, int $limit = 30)
    {
        if ($page < 1) {
            $page = 1;
        }
        $offset = $limit * ($page - 1);

        $query_where = [];
        $params = [];

        if ($name !== null) {
            $query_where[] = "`company_name` LIKE ?";
            $params[] = "%$name%";
        }

        if ($bin !== null) {
            $query_where[] = "`company_bin` LIKE ?";
            $params[] = "%$bin%";
        }

        if ($region !== null) {
            $query_where[] = "`region` LIKE ?";
            $params[] = "%$region%";
        }


        try {
            $stmnt = $this->db->prepare("SELECT * FROM `companies` WHERE " . implode(' AND ', $query_where) . " LIMIT $limit OFFSET $offset");
            $stmnt->execute($params);
            $companies = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $companies[] = $row;
            }
            return $companies;
        } catch (PDOException $e) {
            exit($e);
        }
    }

    public function filterCount(string $name = null, string $bin = null, string $region = null,)
    {
        $query_where_count = [];
        $params = [];

        if ($name !== null) {
            $query_where_count[] = "`company_name` LIKE ?";
            $params[] = "%$name%";
        }

        if ($bin !== null) {
            $query_where_count[] = "`company_bin` LIKE ?";
            $params[] = "%$bin%";
        }

        if ($region !== null) {
            $query_where_count[] = "`region` LIKE ?";
            $params[] = "%$region%";
        }

        try {
            $stmnt = $this->db->prepare("SELECT COUNT(*) FROM `companies` WHERE " . implode(' AND ', $query_where_count));
            $stmnt->execute($params);
            $row = $stmnt->fetch(PDO::FETCH_NUM);
            return $row[0];
        } catch (PDOException $e) {
            exit($e);
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

    public function runQuery(string $query): bool|\PDOStatement
    {
        return $this->db->query($query);
    }

    public function createCompany($company_name, $company_bin, $region, $address, $otrasl, $phone, $email, $boss): bool
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

    public function createCompanyGos(
        $date_last_updated,
        $roles,
        $exists_in_reestr,
        $bin,
        $rnn,
        $namekz,
        $nameru,
        $resident,
        $kato,
        $region,
        $website,
        $email,
        $phone,
        $number_id,
        $date_registration,
        $admin_reporting,
    ): bool
    {
        $query = "INSERT INTO companies (
                       company_name,
                       namekz,
                       company_bin,
                       rnn,
                       kato,
                       region, 
                       website,
                       phone,
                       email,
                       datereg,
                       date_last_updated
                       ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute([$nameru, $namekz,$bin,$rnn,$kato, $region, $website, $phone, $email, $date_registration, $date_last_updated]);

            return true;
        }

catch
(PDOException $e) {
    var_dump('error->', $e);
    return false;
}
    }

    public function writeLink($link): bool
{
    $query = "INSERT INTO links (link) VALUES (?)";
    try {
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$link]);
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



    public function updateCompany($id, $company_name, $company_bin, $region, $address, $otrasl, $phone, $email)
{
    $query = "UPDATE companies SET company_name=?,company_bin=?, region=?, address=?, otrasl=?, phone=? ,email=? WHERE id=?";
    try {
        $stmnt = $this->db->prepare($query);
        $res = $stmnt->execute([$company_name, $company_bin, $region, $address, $otrasl, $phone, $email, $id]);

        return true;
    } catch (PDOException $e) {

    }
}

    public function updateCompanyOked($bin, $statusru, $statuskz, $okedru, $okedkz, $addresskz, $datareg)
{
    $query = "UPDATE companies SET status_ru=?,status_kz=?, oked_ru=?, oked_kz=?, datereg=?, address_kz=? WHERE company_bin=?";
    try {
        $stmnt = $this->db->prepare($query);
        $res = $stmnt->execute([$statusru, $statuskz, $okedru, $okedkz, $addresskz, $datareg, $bin]);

        return true;
    } catch (PDOException $e) {
        var_dump('error>>', $bin, '>');
        return false;
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

    function checkCompanyByBiin(Biin $biin): bool
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

    function checkCompanyByBin($bin): bool
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


