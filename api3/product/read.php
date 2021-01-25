<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//includes
include_once('../config/Database.php');
include_once('../objects/Contractor.php');

$database = new Database();
$pdo = $database->getConnection();
$product = new Product($pdo);

$stmt = $product->read();
$num = $stmt->rowCount();
if ($num>0) {
    $products_arr = [];
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = [
            "ID_kontrahenta" => $ID_kontrahenta,
            "Nazwa" => $Nazwa,
            "NIP" => $NIP,
            "Bank" => $Bank,
        ];

        array_push($products_arr["records"], $product_item);
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
        array("message" => "No contractors found.")
    );
}
