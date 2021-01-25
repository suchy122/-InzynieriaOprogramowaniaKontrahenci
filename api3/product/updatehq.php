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

//posted data
$data = json_decode(file_get_contents("php://input"));
    $hq->ID_siedziby = $data->ID_siedziby;
    $hq->NIP = $data->NIP;
    $hq->Miasto = $data->Miasto;
    $hq->Fax = $data->Fax;
    $hq->Mail = $data->Mail;
    $hq->Telefon = $data->Telefon;
    $hq->Kod_pocztowy = $data->Kod_pocztowy;
    $hq->Numer_domu = $data->Numer_domu;
    $hq->Ulica = $data->Ulica;

    if ($hq->update()) {
        http_response_code(201);

        echo json_encode([
            "message" => "The headquarters was updated."
        ]);
    } else {
        http_response_code(503);

        echo json_encode([
            "message" => "Unable to update the headquarters."
        ]);
    }
