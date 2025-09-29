<?php
header("Content-Type: application/json");
include("../db.php");

$data = json_decode(file_get_contents("php://input"), true);

if(!isset($data["name"]) || !isset($data["price"]) || !isset($data["stock"])) {
    echo json_encode(["error" => "Missing required fields: name, price, stock"]);
    exit;
}

$name = $conn->real_escape_string($data["name"]);
$category = $conn->real_escape_string($data["category"]);
$price = floatval($data["price"]);
$stock = intval($data["stock"]);
$description = $conn->real_escape_string($data["description"]);
$image_url = $conn->real_escape_string($data["image_url"]);

$sql = "INSERT INTO products (name, category, price, stock, description, image_url)
        VALUES ('$name','$category',$price,$stock,'$description','$image_url')";

if($conn->query($sql)){
    echo json_encode(["message"=>"Product created successfully"]);
} else {
    echo json_encode(["error"=>"Insert failed"]);
}
?>
