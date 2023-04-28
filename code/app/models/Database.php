<?php

class Database
{
    private static $instance = null;
    private $conn;
    public $host = 'localhost';
    private $user = 'root';
    private $pass = '12345';
    private $name = 'minicrm';
    private $port = 3306;

    public function __construct()
    {
        echo 'database123';
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name, $this->port);
//        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//        $mysqli = new mysqli($this->host, $this->user, $this->pass, $this->name);
        /* Установите желаемую кодировку после установления соединения */
        $this->conn->set_charset('utf8mb4');
        printf("____Успешно... %s\n", $this->conn->host_info);

//        if($this->conn->connect_error){
//            die('CONNECT FAILED: ' . $this->conn->connect_error);
//        }
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }
}
