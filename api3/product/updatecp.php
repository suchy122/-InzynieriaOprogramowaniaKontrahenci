<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../config/Database.php');
include_once('../objects/Contact_persons.php');

$database = new Database();
$pdo = $database->getConnection();
$Contact_persons = new Contact_persons($pdo);

//posted data
$data = json_decode(file_get_contents("php://input"));
    $Contact_persons->ID_osoby_kontaktowej = $data->ID_osoby_kontaktowej;
    $Contact_persons->ID_siedziby = $data->ID_siedziby;
    $Contact_persons->Imie = $data->Imie;
    $Contact_persons->Nazwisko = $data->Nazwisko;
    $Contact_persons->Telefon = $data->Telefon;
    $Contact_persons->Opis = $data->Opis;
    $Contact_persons->Adres = $data->Adres;

    if ($Contact_persons->update()) {
        http_response_code(201);

        echo json_encode([
            "message" => "The contact person was updated."
        ]);
    } else {
        http_response_code(503);

        echo json_encode([
            "message" => "Unable to update the contact person."
        ]);
    }
