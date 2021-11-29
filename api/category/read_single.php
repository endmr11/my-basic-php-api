<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


$database = new Database();
$db = $database->connect();

$kategori = new Kategori($db);

$kategori->kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : die();

$kategori->read_single();


$kategori_arr = array(
    'kategori_id' => $kategori->kategori_id,
    'kategori_adi' => $kategori->kategori_adi
);


print_r(json_encode($kategori_arr, JSON_NUMERIC_CHECK));
