<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acces-Control-Allow-Methots: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methots,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Product.php';


$database = new Database();
$db = $database->connect();

$urun = new Urun($db);



$data = json_decode(file_get_contents("php://input"));

$urun->urun_adi = $data->urun_adi;
$urun->urun_aciklamasi = $data->urun_aciklamasi;
$urun->urun_fiyati = $data->urun_fiyati;
$urun->urun_agirligi = $data->urun_agirligi;
$urun->urun_resmi = $data->urun_resmi;
$urun->kategori_id = $data->kategori_id;


if ($urun->create()) {
    echo json_encode(
        array('mesaj' => 'Olusturuldu!')
    );
} else {
    echo json_encode(
        array('mesaj' => 'Hata! Olusturulamadi.')
    );
}
