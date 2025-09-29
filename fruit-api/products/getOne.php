<?php
header("Content-Type: application/json");
include("../db.php");

$id = intval($_GET["id"]);
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);

if($row = $result->fetch_assoc()){
    echo json_encode($row);
} else {
    echo json_encode(["error" => "Product not found"]);
}
?>
