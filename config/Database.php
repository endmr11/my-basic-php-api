<?php

class Database
{
    private $host = 'YOUR HOST';
    private $db_name = 'YOUR DB NAME';
    private $username = 'YOUR USERNAME';
    private $password = 'YOUR PASSWORD';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Hata: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
