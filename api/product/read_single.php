<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Product.php';


$database = new Database();
$db = $database->connect();

$urun = new Urun($db);

$urun->urun_id = isset($_GET['urun_id']) ? $_GET['urun_id'] : die();

$urun->read_single();


$urun_arr = array(
    'urun_id' => $urun->urun_id,
    'urun_adi' => $urun->urun_adi,
    'urun_aciklamasi' => $urun->urun_aciklamasi,
    'urun_fiyati' => $urun->urun_fiyati,
    'urun_agirligi' => $urun->urun_agirligi,
    'urun_resmi' => $urun->urun_resmi,
    'kategori_id' => $urun->kategori_id,
    'kategori_adi' => $urun->kategori_adi
);


print_r(json_encode($urun_arr, JSON_NUMERIC_CHECK));
