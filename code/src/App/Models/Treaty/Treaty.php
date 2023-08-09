<?php

namespace App\Models\Treaty;

use Kuvardin\KzIdentifiers\Biin;
use Kuvardin\KzIdentifiers\Bin;
use App\Models\Database;
use PDO;
use PDOException;
use Miko\UchetKz\Models\Organization as UchetOrganization;

class Treaty
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `treaties` LIMIT 1");
        } catch (PDOException $error) {
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
        var_dump('======================================== create table');

        $treatyTableQuery = "CREATE TABLE IF NOT EXISTS `treaties` (
             `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
             `number` VARCHAR(255) NOT NULL, 
             `contractor` VARCHAR(255) NOT NULL, 
             `iniciator` VARCHAR(255) NOT NULL, 
             `subject` VARCHAR(255) NOT NULL, 
             `sum` VARCHAR(255) NOT NULL, 
             `sum_service` VARCHAR(255) NOT NULL, 
             `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

        $this->db->beginTransaction();
        try {
            $this->db->exec($treatyTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getTreaties(){
        $query = "SELECT * FROM `treaties`";

        try {
            $stmnt = $this->db->query($query);
            $treaties = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $treaties[] = $row;
            }

            return $treaties;
        } catch (PDOException $e) {

        }
    }

    public function getTreatiesNumber(): int
    {
        $query = "SELECT COUNT(*) FROM `treaties`";
        $stmnt = $this->db->query($query);
        $row = $stmnt->fetch(PDO::FETCH_NUM);
        return $row[0];
    }

    public function getAllTreaties($page, $limit = null)
    {
        $limit ??= 30;
        $page ??= 1;
        if ($page < 1) {
            $page = 1;
        }

        $offset = $limit * ($page - 1);
        $query = "SELECT * FROM `treaties` LIMIT $limit OFFSET $offset";



        try {
            $stmnt = $this->db->query($query);
            $treaties = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $treaties[] = $row;
            }

            return $treaties;
        } catch (PDOException $e) {

        }
    }
     public function getLimitTreaties($limit,$offset){
         $query= "select * from `treaties` limit $limit offset $offset";
         try {
             $stmnt = $this->db->query($query);
             $treaties = [];
             while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                 $treaties[] = $row;
             }

             return $treaties;
         } catch (PDOException $e) {

         }
     }

    public function filter(string $name = null, string $bin = null, string $region = null,int $page = 1,int $limit = 30){
        if ($page < 1) {
            $page = 1;
        }
        $offset = $limit * ($page - 1);

        $query_where = [];
        $params = [];

        if ($name !== null) {
            $query_where[] = "`contractor` LIKE ?";
            $params[] = "%$name%";
        }

        if ($bin !== null) {
            $query_where[] = "`contractor_bin` LIKE ?";
            $params[] = "%$bin%";
        }


        try {
            $stmnt = $this->db->prepare("SELECT * FROM `treaties` WHERE " . implode(' AND ', $query_where) . " LIMIT $limit OFFSET $offset");
            $stmnt->execute($params);
            $treaties = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $companies[] = $row;
            }
            return $treaties;
        } catch (PDOException $e) {
            exit($e);
        }
    }

    public function filterCount(string $name = null, string $bin = null, string $region = null,){
        $query_where_count = [];
        $params = [];

        if ($name !== null) {
            $query_where_count[] = "`contractor_name` LIKE ?";
            $params[] = "%$name%";
        }

        if ($bin !== null) {
            $query_where_count[] = "`contractor_bin` LIKE ?";
            $params[] = "%$bin%";
        }

        try {
            $stmnt = $this->db->prepare("SELECT COUNT(*) FROM `treaties` WHERE " . implode(' AND ', $query_where_count));
            $stmnt->execute($params);
            $row = $stmnt->fetch(PDO::FETCH_NUM);
            return $row[0];
        } catch (PDOException $e) {
            exit($e);
        }
    }

    public function getTreatiesById($id): bool|array
    {
        $query = "SELECT * FROM `treaties` WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $err) {
            return false;
        }
    }

    public function createTreaty($number_treties,
                                    $contractor ,
                                    $iniciator ,
                                    $subject ,
                                    $sum ,
                                    $sum_service,
                                    $created_at ,
                                    $file,
                                    $file_content = ''
    )
    {
        $query = "INSERT INTO `treaties` (number,contractor,iniciator, subject,sum,sum_service,created_at, file_name, file_type, file_content) VALUES (?,?,?,?,?,?,?,?,?,?)";

        $file_name = $file['name'] ?? '';
        $file_type = $file['type'] ?? '';
        var_dump('$file_name>',$file_name);
        var_dump('$file_type>',$file_type);
        var_dump('$query>', $query);
        var_dump('$file>',$file);
//        exit();

        try {
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute([$number_treties, $contractor, $iniciator, $subject, $sum, $sum_service, $created_at, $file_name, $file_type, $file_content]);

            return true;
        } catch (PDOException $e) {
            var_dump('error->', $e);
            return false;
        }
    }


    public function updateTreaty($id, $company_name,$company_bin, $region, $address, $otrasl, $phone, $email)
    {
        $query = "UPDATE `treaties` SET company_name=?,company_bin=?, region=?, address=?, otrasl=?, phone=? ,email=? WHERE id=?";
        try {
            $stmnt = $this->db->prepare($query);
            $res = $stmnt->execute([$company_name, $company_bin, $region, $address, $otrasl, $phone, $email, $id]);

            return true;
        } catch (PDOException $e) {

        }
    }

    public function deleteTreaty($id): bool
    {
        $query = "DELETE FROM `treaties` WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }
}


