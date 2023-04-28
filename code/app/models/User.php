<?php

class User
{

    /**
     * @var mysqli $db
     */


    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function index()
    {

    }

    public function readAll()
    {
        $result = $this->db->query("SELECT * FROM users");
        $users = [];
        echo '<br/>';
//        var_dump($result);
        echo '<br/>';
        echo '<br/>';
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        var_dump($row);
//        echo '<div class="container border-1 bg-black border-white font-monospace">';
//        var_dump($users);
//        echo '</div>';

        return $users;
    }

    public function create($data)
    {
        $login = $data['login'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $admin = isset($data['admin']) ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');

        $stmnt = $this->db->prepare("INSERT INTO users (login, password, is_admin, created_at) VALUE (?,?,?,?)");
        $stmnt->bind_param("ssis", $login, $password, $admin, $created_at);

        if ($stmnt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}






