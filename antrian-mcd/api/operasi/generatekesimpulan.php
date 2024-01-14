<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/Antrian.php';

// Fungsi Keanggotaan
function fuzzyMembership($value, $low, $mid, $high)
{
    $membership = array(
        'low' => max(0, 1 - ($value - $low) / ($mid - $low)),
        'mid' => max(0, min(1, ($value - $low) / ($mid - $low), 1 - ($value - $mid) / ($high - $mid))),
        'high' => max(0, ($value - $mid) / ($high - $mid))
    );

    return $membership;
}

// Aturan Fuzzy
function fuzzyRules($sk, $spk)
{
    $tingkat_kesibukan = '';

    $sk_membership = fuzzyMembership($sk, 0, 10, 20);
    $spk_membership = fuzzyMembership($spk, 0, 10, 20);

    // Contoh aturan fuzzy sederhana
    if ($sk_membership['high'] > 0 && $spk_membership['low'] > 0) {
        $tingkat_kesibukan = 'Tinggi';
    } elseif ($sk_membership['low'] > 0 || $spk_membership['mid'] > 0) {
        $tingkat_kesibukan = 'Sedang';
    } else {
        $tingkat_kesibukan = 'Rendah';
    }

    return $tingkat_kesibukan;
}

$database = new Database();
$db = $database->getConnection();
$item = new Antrian($db);
$item->generateByAVG();

if ($item->waktu_datang != null) {
    // Konversi nilai waktu ke format tertentu (misalnya, format H:i:s untuk jam:menit:detik)
    $formattedwaktudatang = date('H:i:s', strtotime($item->waktu_datang));
    $formattedmaxwaktudatang = date('H:i:s', strtotime($item->maxwaktudatang));

    // Fuzzy Logic
    $tingkat_kesibukan = fuzzyRules($item->selisihkedatangan, $item->selisihpelayanankasir);

    // create response array
    $data_arr = array(
        "waktu_datang" => "Jika awal waktu kedatangan konsumen pada: " . $formattedwaktudatang,
        "max_waktudatang" => " dan kedatangan pelanggan terakhir pada: " . $formattedmaxwaktudatang . ",",
        "selisihkedatangan" => round($item->selisihkedatangan),
        "selisihpelayanankasir" => round($item->selisihpelayanankasir),
        "selisihkeluarantrian" => round($item->selisihkeluarantrian),
        "selisihminkeluarantrian" => round($item->minselisihkeluarantrian),
        "selisihmaxkeluarantrian" => round($item->maxselisihkeluarantrian),
        "tingkat_kesibukan" => $tingkat_kesibukan
    );

    http_response_code(200);
    echo json_encode($data_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "User not found."));
}
