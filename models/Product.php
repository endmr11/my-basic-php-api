<?php
class Urun
{
    private $conn;
    private $table = 'urun';

    public $urun_id;
    public $kategori_id;
    public $kategori_adi;
    public $urun_adi;
    public $urun_aciklamasi;
    public $urun_fiyati;
    public $urun_agirligi;
    public $urun_resmi;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table . ' LEFT JOIN kategori ON ' . $this->table . '.kategori_id=kategori.kategori_id ORDER BY urun_id ASC ';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table . ' LEFT JOIN kategori ON ' . $this->table . '.kategori_id=kategori.kategori_id WHERE urun_id=? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->urun_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->urun_adi = $row['urun_adi'];
        $this->urun_adi = $row['urun_aciklamasi'];
        $this->urun_fiyati = $row['urun_fiyati'];
        $this->urun_agirligi = $row['urun_agirligi'];
        $this->urun_resmi = $row['urun_resmi'];
        $this->kategori_id = $row['kategori_id'];
        $this->kategori_adi = $row['kategori_adi'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET urun_adi =:urunadi,urun_aciklamasi=:urunaciklamasi,urun_fiyati=:urunfiyati,urun_agirligi=:urunagirligi,urun_resmi=:urunresmi,kategori_id=:kategoriid';
        $stmt = $this->conn->prepare($query);
        $this->urun_adi = htmlspecialchars(strip_tags($this->urun_adi));
        $this->urun_aciklamasi = htmlspecialchars(strip_tags($this->urun_aciklamasi));
        $this->urun_fiyati = htmlspecialchars(strip_tags($this->urun_fiyati));
        $this->urun_agirligi = htmlspecialchars(strip_tags($this->urun_agirligi));
        $this->urun_resmi = htmlspecialchars(strip_tags($this->urun_resmi));
        $this->kategori_id = htmlspecialchars(strip_tags($this->kategori_id));

        $stmt->bindParam(':urunadi', $this->urun_adi);
        $stmt->bindParam(':urunaciklamasi', $this->urun_aciklamasi);
        $stmt->bindParam(':urunfiyati', $this->urun_fiyati);
        $stmt->bindParam(':urunagirligi', $this->urun_agirligi);
        $stmt->bindParam(':urunresmi', $this->urun_resmi);
        $stmt->bindParam(':kategoriid', $this->kategori_id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Hata: %s.\n", $stmt->error);

        return false;
    }




    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET urun_adi =:urunadi,urun_aciklamasi=:urunaciklamasi,urun_fiyati=:urunfiyati,urun_agirligi=:urunagirligi,urun_resmi=:urunresmi,kategori_id=:kategoriid WHERE urun_id=:urunid';
        $stmt = $this->conn->prepare($query);
        $this->urun_adi = htmlspecialchars(strip_tags($this->urun_adi));
        $this->urun_aciklamasi = htmlspecialchars(strip_tags($this->urun_aciklamasi));
        $this->urun_fiyati = htmlspecialchars(strip_tags($this->urun_fiyati));
        $this->urun_agirligi = htmlspecialchars(strip_tags($this->urun_agirligi));
        $this->urun_resmi = htmlspecialchars(strip_tags($this->urun_resmi));
        $this->kategori_id = htmlspecialchars(strip_tags($this->kategori_id));
        $this->urun_id = htmlspecialchars(strip_tags($this->urun_id));

        $stmt->bindParam(':urunadi', $this->urun_adi);
        $stmt->bindParam(':urunaciklamasi', $this->urun_aciklamasi);
        $stmt->bindParam(':urunfiyati', $this->urun_fiyati);
        $stmt->bindParam(':urunagirligi', $this->urun_agirligi);
        $stmt->bindParam(':urunresmi', $this->urun_resmi);
        $stmt->bindParam(':kategoriid', $this->kategori_id);
        $stmt->bindParam(':urunid', $this->urun_id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Hata: %s.\n", $stmt->error);

        return false;
    }


    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE urun_id=:urunid';
        $stmt = $this->conn->prepare($query);
        $this->urun_id = htmlspecialchars(strip_tags($this->urun_id));
        $stmt->bindParam(':urunid', $this->urun_id);
        if ($stmt->execute()) {
            return true;
        }

        printf("Hata: %s.\n", $stmt->error);

        return false;
    }
}
