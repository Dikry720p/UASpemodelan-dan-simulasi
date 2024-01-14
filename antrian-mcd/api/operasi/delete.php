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

// Set data to Antrian object
$item->id = $data->id;

// Try to delete Antrian
if ($item->deleteAntrian()) {
    echo json_encode(['message' => 'Antrian Dihapus.']);
} else {
    echo json_encode(['message' => 'Data could not be deleted.', 'error' => $db->errorInfo()]);
}
?>
