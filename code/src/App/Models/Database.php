<?php

namespace App\Models;
use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $conn;

    public function __construct()
    {
        $config = require_once ROOT_DIR . '/config.php';
//        var_dump($config);
        $db_host = DB_HOST;
        $db_user = DB_USER;
        $db_pass = DB_PASS;
        $db_name = DB_NAME;

        try {
            $connectDriver = "mysql:host=$db_host;dbname=$db_name";
            $this->conn = new PDO($connectDriver, $db_user, $db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo 'success';
        } catch (PDOException $err) {
            echo "connect failed" . $err->getMessage();
        }
    }

    public static function getInstance(): ?Database
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
