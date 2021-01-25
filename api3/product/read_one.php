<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.php';
include_once '../objects/Contractor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new Product($db);

$product->NIP = isset($_GET['NIP']) ? $_GET['NIP'] : die();

$product->readOne();

if ($product->NIP != null) {
    $product_arr = [
        "ID_kontrahenta" => $product->ID_kontrahenta,
        "Nazwa" => $product->Nazwa,
        "NIP" => $product->NIP,
        "Bank" => $product->Bank,

    ];

    http_response_code(200);

    echo json_encode($product_arr);
} else {
    http_response_code(404);

    echo json_encode([
        "message" => "Contracotr not found."
    ]);
}
