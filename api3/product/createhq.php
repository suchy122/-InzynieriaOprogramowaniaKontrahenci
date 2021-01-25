<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../config/Database.php');
include_once('../objects/hq.php');

$database = new Database();
$pdo = $database->getConnection();
$hq = new hq($pdo);

echo file_get_contents("php://input");
//posted data
$data = json_decode(file_get_contents("php://input"));


if (!empty($data->NIP) && !empty($data->Miasto) && !empty($data->Fax) && !empty($data->Mail) && !empty($data->Telefon) && !empty($data->Kod_pocztowy) && !empty($data->Numer_domu) && !empty($data->Ulica)) {
    $hq->NIP = $data->NIP;
    $hq->Miasto = $data->Miasto;
    $hq->Fax = $data->Fax;
    $hq->Mail = $data->Mail;
    $hq->Telefon = $data->Telefon;
    $hq->Kod_pocztowy = $data->Kod_pocztowy;
    $hq->Numer_domu = $data->Numer_domu;
    $hq->Ulica = $data->Ulica;

    if ($hq->create()) {
        http_response_code(201);

        echo json_encode([
            "message" => "The headquarters was added."
        ]);
    } else {
        http_response_code(503);

        echo json_encode([
            "message" => "Unable to add the headquarters."
        ]);
    }
} else {
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create headquarters. Data is incomplete."));
}
