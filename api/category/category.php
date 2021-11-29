<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Category.php';


$database = new Database();
$db = $database->connect();

$kategori = new Kategori($db);

$result = $kategori->read();
$num = $result->rowCount();

$data = json_decode(file_get_contents("php://input"));
if ($data) {
    if (empty($data->kategori_adi)) {
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
    } elseif (isset($data->kategori_id)) {

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
    } else {
        $kategori->kategori_adi = $data->kategori_adi;
        if ($kategori->create()) {
            echo json_encode(
                array('mesaj' => 'Olusturuldu!')
            );
        } else {
            echo json_encode(
                array('mesaj' => 'Hata! Olusturulamadi.')
            );
        }
    }
} elseif (isset($_GET['kategori_id'])) {
    $kategori->kategori_id = $_GET['kategori_id'];
    $kategori->read_single();
    $kategori_arr = array(
        'kategori_id' => $kategori->kategori_id,
        'kategori_adi' => $kategori->kategori_adi
    );
    print_r(json_encode($kategori_arr, JSON_NUMERIC_CHECK));
} else {
    if ($num > 0) {
        $kategori_arr = array();
        $kategori_arr['data'] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $kategori_item = array(
                'kategori_id' => $kategori_id,
                'kategori_adi' => $kategori_adi
            );
            array_push($kategori_arr['data'], $kategori_item);
        }
        echo strip_tags(preg_replace('/<[^>]*>/', '', str_replace(array("&nbsp;", "\n", "\r"), "", html_entity_decode(json_encode($kategori_arr, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8'))));
        //echo json_encode($kategori_arr, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(
            array('mesaj' => 'Kategori bulunamadi!')
        );
    }
}






