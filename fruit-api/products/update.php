<?php
header("Content-Type: application/json");
include("../db.php");

$id = intval($_GET["id"]);
$data = json_decode(file_get_contents("php://input"), true);

$sql = "UPDATE products SET 
        name='{$data["name"]}', 
        category='{$data["category"]}', 
        price={$data["price"]}, 
        stock={$data["stock"]}, 
        description='{$data["description"]}', 
        image_url='{$data["image_url"]}' 
        WHERE id=$id";

if($conn->query($sql)){
    echo json_encode(["message"=>"Product updated successfully"]);
} else {
    echo json_encode(["error"=>"Update failed"]);
}
?>
