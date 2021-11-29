<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acces-Control-Allow-Methots: PUT');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methots,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


$database = new Database();
$db = $database->connect();

$kategori = new Kategori($db);



$data = json_decode(file_get_contents("php://input"));

$kategori->kategori_id = $data->kategori_id;
$kategori->kategori_adi = $data->kategori_adi;


if ($kategori->update()) {
    echo json_encode(
        array('mesaj' => 'Güncellendi!')
    );
} else {
    echo json_encode(
        array('mesaj' => 'Hata! Güncellenemedi.')
    );
}
