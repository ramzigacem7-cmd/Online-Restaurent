<?php
require_once "includes/db.php";
header("Content-Type: application/json; charset=UTF-8");
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);
if($data === null){
    echo json_encode([
     "success" => false,
     "message" => "Invalid JSON"
    ]);
    exit;
}
$order_id = $data["order_id"];
try{
$stmt = $pdo->prepare("delete from orders where order_id =?");
$stmt->execute([$order_id]);
$stmt = $pdo->prepare("delete from order_items where order_id =?");
$stmt->execute([$order_id]);
 echo json_encode([
     "success" => true,
     "message" => "valid"
    ]);
}catch(PDOException $e){
$e->getMessage();
}


?>