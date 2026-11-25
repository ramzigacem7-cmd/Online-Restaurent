<?php 
$host="localhost";
$db="online_restaurant";
$username="root";
$password="";
try{
$pdo = new PDO("mysql:host=$host;dbname=$db;",
$username,
$password);

}catch(PDOException $e){
  echo $e->getMessage();
}

?>