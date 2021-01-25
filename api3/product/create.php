<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../config/Database.php');
include_once('../objects/Contractor.php');

$database = new Database();
$pdo = $database->getConnection();
$product = new Product($pdo);

//posted data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->Nazwa) && !empty($data->NIP) && !empty($data->Bank)) {
    $product->Nazwa = $data->Nazwa;
    $product->NIP = $data->NIP;
    $product->Bank = $data->Bank;

    if ($product->create()) {
        http_response_code(201);

        echo json_encode([
            "message" => "The contractor was added."
        ]);
    } else {
        http_response_code(503);

        echo json_encode([
            "message" => "Unable to add the contractor."
        ]);
    }
} else {
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create contractor. Data is incomplete."));
}
