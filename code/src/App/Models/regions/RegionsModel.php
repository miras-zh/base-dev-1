<?php

namespace App\Models\regions;

use App\Models\Database;
use PDO;
use PDOException;

class RegionsModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `regions` LIMIT 1");
        } catch (PDOException $error) {
            $this->createTable();
        }
    }

    public function createTable(): bool
    {
        $regionTableQuery = "CREATE TABLE IF NOT EXISTS `regions` (
            `id` INT(11) NOT NULL PRIMARY KEY ,
            `region_name` VARCHAR(255) NOT NULL,
            `region_description` TEXT)";

        $this->db->beginTransaction();
        try {
            $this->db->exec($regionTableQuery);
            $this->db->commit();
            return true;
        } catch (PDOException $err) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getAllRegion()
    {
        $query = "SELECT * FROM `regions`";

        try {
            $stmnt = $this->db->query("SELECT * FROM `regions`");
            $regions = [];
            while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $regions[] = $row;
            }
            return $regions;
        } catch (PDOException $e) {

        }
    }

    public function getRegionById($id): bool|array
    {
        $query = "SELECT * FROM regions WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $region = $stmt->fetch(PDO::FETCH_ASSOC);

            return $region;

        } catch (PDOException $err) {
            return false;
        }
    }

    public function createRegion($region_name, $region_description)
    {
        $query = "INSERT INTO regions (region_name,region_description) VALUES (?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $res = $stmt->execute([$region_name, $region_description]);

            return true;
        } catch (PDOException $e) {

        }
    }

    public function updateRegion($id, $region_name, $region_description)
    {
        $query = "UPDATE regions SET region_name=?,region_description=? WHERE id=?";

        try {
            $stmnt = $this->db->prepare($query);
            $stmnt->execute([$region_name, $region_description, $id]);
            return true;
        } catch (PDOException $e) {

        }
    }

    public function deleteRegion($id): bool
    {
        $query = "DELETE FROM regions WHERE id= ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (PDOException $error) {
            return false;
        }
    }
}


