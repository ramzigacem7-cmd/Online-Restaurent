<?php
require_once "includes/db.php";
header("Content-Type: application/json; charset=UTF-8");
try{
$stmt = $pdo->prepare("select o.order_id, o.status, o.order_date, oi.quantity, p.name as product_name, p.price as product_price  from orders o left join order_items oi on o.order_id = oi.order_id left join product p on p.product_id = oi.product_id");
$stmt->execute();
$rows = $stmt->fetchAll();
$orders = [];

foreach($rows as $row){
   $id = $row["order_id"];
   if(!isset($orders[$id])){
    $orders[$id] = [
        "order_id" => $id,
        "status" => $row["status"],
        "order_date" => $row["order_date"],
        "items" => []
    ];
   }
   $orders[$id]["items"][] =[
    "product_name" => $row["product_name"],
    "product_price" => $row["product_price"],
    "quantity" => $row["quantity"]
   ];
  
}
 echo json_encode([
    "saved_orders" =>array_values( $orders)
   ]);


}catch(PDOException $e){

 echo json_encode([
        "message" => "error"
    ]);
};


?>