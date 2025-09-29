<?php
header("Content-Type: application/json");
include("../db.php");

$id = intval($_GET["id"]);
$sql = "DELETE FROM products WHERE id=$id";

if($conn->query($sql)){
    echo json_encode(["message"=>"Product deleted successfully"]);
} else {
    echo json_encode(["error"=>"Delete failed"]);
}
?>
