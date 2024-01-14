<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/Antrian.php';

$database = new Database();
$db = $database->getConnection();
$item = new Antrian($db);
$data = json_decode(file_get_contents("php://input"));
$latestArrivalTime = $item->getLatestArrivalTime();

$item->waktu_datang = $data->waktu_datang;
$item->awal_pelayanan = $data->awal_pelayanan;
$item->keluar = $data->keluar;
$item->selisihkedatangan = calculateTimeDifference($latestArrivalTime['waktu_datang'], $data->waktu_datang);
$item->selisihpelayanankasir = calculateTimeDifference($latestArrivalTime['awal_pelayanan'], $data->awal_pelayanan);
$item->selisihkeluarantrian = calculateTimeDifference($latestArrivalTime['keluar'], $data->keluar);
// $item->selisihkedatangan = calculateTimeDifference($latestArrivalTime['waktu_datang'], $data->waktu_datang);
// $item->selisihpelayanankasir = calculateTimeDifference($data->waktu_datang, $data->awal_pelayanan);
// $item->selisihkeluarantrian = calculateTimeDifference($data->waktu_datang, $data->keluar);


if ($item->createAntrian()) {
    echo json_encode(['message' => 'Data Customer Berhasil Ditambahkan.']);
} else {
    echo json_encode(['message' => 'Data Customer Gagal Ditambahkan.']);
}
function calculateTimeDifference($time1, $time2)
{
    $datetime1 = new DateTime($time1);
    $datetime2 = new DateTime($time2);
    $interval = $datetime1->diff($datetime2);

    return $interval->i + $interval->h * 60;
}
