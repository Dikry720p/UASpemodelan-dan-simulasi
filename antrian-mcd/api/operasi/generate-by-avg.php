<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/Antrian.php';

$database = new Database();
$db = $database->getConnection();
$item = new Antrian($db);
$item->generateByAVG();

if ($item->waktu_datang != null) {
    // Konversi nilai waktu ke format tertentu (misalnya, format H:i:s untuk jam:menit:detik)
    $formattedwaktudatang = date('H:i:s', strtotime($item->waktu_datang));
    $formattedmaxwaktudatang = date('H:i:s', strtotime($item->maxwaktudatang));

    // create response array
    $data_arr = array(
        "waktu_datang" => "Jika awal waktu kedatangan konsumen pada: " . $formattedwaktudatang,
        "max_waktudatang" => " dan kedatangan pelanggan terakhir pada:" . $formattedmaxwaktudatang . ",",
        "selisihkedatangan" => round($item->selisihkedatangan),
        "selisihpelayanankasir" => round($item->selisihpelayanankasir),
        "selisihkeluarantrian" => round($item->selisihkeluarantrian),
        "selisihminkeluarantrian" => round($item->minselisihkeluarantrian),
        "selisihmaxkeluarantrian" => round($item->maxselisihkeluarantrian)
    );

    http_response_code(200);
    echo json_encode($data_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "User not found."));
}
