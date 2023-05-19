<?php

namespace models;
class Database
{
    private static $instance = null;
    private $conn;

    public function __construct()
    {
        $config = require_once __DIR__ . '/../../config.php';
//        var_dump($config);
        $db_host = $config['db_host'];
        $db_user = $config['db_user'];
        $db_pass = $config['db_pass'];
        $db_name = $config['db_name'];

        try {
            $connectDriver = "mysql:host=$db_host;dbname=$db_name";
            $this->conn = new PDO($connectDriver, $db_user, $db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo 'success';
        } catch (PDOException $err) {
            echo "connect failed" . $err->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
