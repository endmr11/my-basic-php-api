<?php

class Kategori
{
    private $conn;
    private $table = 'kategori';

    public $kategori_id;
    public $kategori_adi;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT kategori_id,kategori_adi FROM ' . $this->table . ' ORDER BY kategori_id ASC ';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE kategori_id=? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->kategori_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->kategori_id = $row['kategori_id'];
        $this->kategori_adi = $row['kategori_adi'];
    }


    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET kategori_adi =:kategoriadi';
        $stmt = $this->conn->prepare($query);
        $this->kategori_adi = htmlspecialchars(strip_tags($this->kategori_adi));

        $stmt->bindParam(':kategoriadi', $this->kategori_adi);

        if ($stmt->execute()) {
            return true;
        }

        printf("Hata: %s.\n", $stmt->error);

        return false;
    }



    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET kategori_adi =:kategoriadi WHERE kategori_id=:kategoriid';
        $stmt = $this->conn->prepare($query);
        $this->kategori_adi = htmlspecialchars(strip_tags($this->kategori_adi));
        $this->kategori_id = htmlspecialchars(strip_tags($this->kategori_id));

        $stmt->bindParam(':kategoriadi', $this->kategori_adi);
        $stmt->bindParam(':kategoriid', $this->kategori_id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Hata: %s.\n", $stmt->error);

        return false;
    }


    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE kategori_id=:kategoriid';
        $stmt = $this->conn->prepare($query);
        $this->kategori_id = htmlspecialchars(strip_tags($this->kategori_id));
        $stmt->bindParam(':kategoriid', $this->kategori_id);
        if ($stmt->execute()) {
            return true;
        }

        printf("Hata: %s.\n", $stmt->error);

        return false;
    }
}
