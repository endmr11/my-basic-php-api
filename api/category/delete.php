<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acces-Control-Allow-Methots: DELETE');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methots,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


$database = new Database();
$db = $database->connect();

$kategori = new Kategori($db);



$data = json_decode(file_get_contents("php://input"));

$kategori->kategori_id = $data->kategori_id;



if ($kategori->delete()) {
    echo json_encode(
        array('mesaj' => 'Silindi!')
    );
} else {
    echo json_encode(
        array('mesaj' => 'Hata! Silinemedi.')
    );
}
