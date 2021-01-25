<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.php';
include_once '../objects/hq.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$hq = new hq($db);

$hq->ID_siedziby = isset($_GET['ID_siedziby']) ? $_GET['ID_siedziby'] : die();

$hq->readOne();

if ($hq->ID_siedziby != null) {
    $product_arr = [
        "ID_siedziby" => $hq->ID_siedziby,
        "NIP_kontrahenta" => $hq->NIP,
        "Miasto" => $hq->Miasto,
        "Fax" => $hq->Fax,
        "Mail" => $hq->Mail,
        "Telefon" => $hq->Telefon,
        "Kod_pocztowy" => $hq->Kod_pocztowy,
        "Numer_domu" => $hq->Numer_domu,
        "Ulica" => $hq->Ulica,

    ];

    http_response_code(200);

    echo json_encode($product_arr);
} else {
    http_response_code(404);

    echo json_encode([
        "message" => "Headquarters not found."
    ]);
}
