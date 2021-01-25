<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.php';
include_once '../objects/json.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$json = new json($db);

$json->NIP = isset($_GET['NIP']) ? $_GET['NIP'] : die();

$json->json();

if ($json->NIP != null) {
    $product_arr = [
            "ID_kontrahenta" => $json->ID_kontrahenta,
            "Nazwa" => $json->Nazwa,
            "NIP" => $json->NIP,
            "Adres" => $json->Adres,
            "Mail" => $json->Mail,
            "Telefon" => $json->Telefon,
            "Bank" => $json->Bank,

    ];

    http_response_code(200);

    echo json_encode($product_arr);
} else {
    http_response_code(404);

    echo json_encode([
        "message" => "Datas not found."
    ]);
}
