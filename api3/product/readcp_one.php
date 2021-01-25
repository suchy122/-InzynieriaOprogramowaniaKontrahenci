<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.php';
include_once '../objects/Contact_Persons.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$Contact_Persons = new Contact_Persons($db);

$Contact_Persons->ID_osoby_kontaktowej = isset($_GET['ID_osoby_kontaktowej']) ? $_GET['ID_osoby_kontaktowej'] : die();

$Contact_Persons->readOne();

if ($Contact_Persons->ID_osoby_kontaktowej != null) {
    $product_arr = [
        "ID_osoby_kontaktowej" => $Contact_Persons->ID_osoby_kontaktowej,
        "ID_siedziby" => $Contact_Persons->ID_siedziby,
        "Imie" => $Contact_Persons->Imie,
        "Nazwisko" => $Contact_Persons->Nazwisko,
        "Telefon" => $Contact_Persons->Telefon,
        "Opis" => $Contact_Persons->Opis,
        "Adres" => $Contact_Persons->Adres,

    ];

    http_response_code(200);

    echo json_encode($product_arr);
} else {
    http_response_code(404);

    echo json_encode([
        "message" => "Contact Person not found."
    ]);
}
