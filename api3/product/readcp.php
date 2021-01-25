<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//includes
include_once('../config/Database.php');
include_once('../objects/Contact_persons.php');

$database = new Database();
$pdo = $database->getConnection();
$Contact_persons = new Contact_persons($pdo);

$stmt = $Contact_persons->read();
$num = $stmt->rowCount();
if ($num>0) {
    $products_arr = [];
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $Contact_persons_item = [
            "ID_osoby_kontaktowej" => $ID_osoby_kontaktowej,
            "ID_siedziby" => $ID_siedziby,
            "Imie" => $Imie,
            "Nazwisko" => $Nazwisko,
            "Telefon" => $Telefon,
            "Opis" => html_entity_decode($Opis),
            "Adres" => $Adres,
        ];

        array_push($products_arr["records"], $Contact_persons_item);
    }

    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($products_arr);
} else {
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No contact persons found.")
    );
}
