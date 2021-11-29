<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Product.php';


$database = new Database();
$db = $database->connect();

$urun = new Urun($db);

$result = $urun->read();
$num = $result->rowCount();


$data = json_decode(file_get_contents("php://input"));
if ($data) {

    if (empty($data->urun_adi)) {
        $urun->urun_id = $data->urun_id;
        if ($urun->delete()) {
            echo json_encode(
                array('mesaj' => 'Silindi!')
            );
        } else {
            echo json_encode(
                array('mesaj' => 'Hata! Silinemedi.')
            );
        }
    } elseif (isset($data->urun_id)) {
        $urun->urun_id = $data->urun_id;
        $urun->urun_adi = $data->urun_adi;
        $urun->urun_aciklamasi = $data->urun_aciklamasi;
        $urun->urun_fiyati = $data->urun_fiyati;
        $urun->urun_agirligi = $data->urun_agirligi;
        $urun->urun_resmi = $data->urun_resmi;
        $urun->kategori_id = $data->kategori_id;


        if ($urun->update()) {
            echo json_encode(
                array('mesaj' => 'Güncellendi!')
            );
        } else {
            echo json_encode(
                array('mesaj' => 'Hata! Güncellenemedi.')
            );
        }
    } else {
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
    }
} elseif (isset($_GET['urun_id'])) {

    $urun->urun_id = $_GET['urun_id'];

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
} else {
    if ($num > 0) {
        $urun_arr = array();
        $urun_arr['data'] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $urun_item = array(
                'urun_id' => $urun_id,
                'urun_adi' => $urun_adi,
                'urun_aciklamasi' => $urun_aciklamasi,
                'urun_fiyati' => $urun_fiyati,
                'urun_agirligi' => $urun_agirligi,
                'urun_resmi' => $urun_resmi,
                'kategori_id' => $kategori_id,
                'kategori_adi' => $kategori_adi
            );
            array_push($urun_arr['data'], $urun_item);
        }

        echo strip_tags(preg_replace('/<[^>]*>/','',str_replace(array("&nbsp;","\n","\r"),"",html_entity_decode(json_encode($urun_arr, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE),ENT_QUOTES,'UTF-8'))));
        //echo json_encode($urun_arr, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(
            array('mesaj' => 'Urun bulunamadi!')
        );
    }
}









/* html_entity_decode($urun_ornek) always_populate_raw_post_data = -1*/
