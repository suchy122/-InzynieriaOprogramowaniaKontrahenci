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

if (!empty($data->ID_siedziby) && !empty($data->Imie) && !empty($data->Nazwisko) && !empty($data->Telefon) && !empty($data->Opis) && !empty($data->Adres)) {
    $Contact_persons->ID_siedziby = $data->ID_siedziby;
    $Contact_persons->Imie = $data->Imie;
    $Contact_persons->Nazwisko = $data->Nazwisko;
    $Contact_persons->Telefon = $data->Telefon;
    $Contact_persons->Opis = $data->Opis;
    $Contact_persons->Adres = $data->Adres;

    if ($Contact_persons->create()) {
        http_response_code(201);

        echo json_encode([
            "message" => "The contact person was added."
        ]);
    } else {
        http_response_code(503);

        echo json_encode([
            "message" => "Unable to add the contact person."
        ]);
    }
} else {
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create contact person. Data is incomplete."));
}
