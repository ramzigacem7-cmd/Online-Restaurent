<?php 
$message ="";
require "includes/db.php";
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
$email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST,"password");
if(!$email){
    $message ="enter email";
}else if(!$password){
$message = "enter your password ";
}else
 if(strlen($password)< 8){
$message = "password should be at least 8 charecters";
}else{
$stmt = $pdo->prepare("select * from admin where email=?");
$stmt->execute([$email]);
$admin = $stmt->fetch();
if($admin){
if(password_verify($password,$admin["password"])){
    $_SESSION["id"]=$admin["id_admin"];
    header("location:admin.php");
    exit;
}else{

    $message =  "user not found";
}
}
}
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
   
    <form action="" method="POST">
         <h3>LOG IN</h3>
     <input type="email" name="email" placeholder="enter email">
     <input type="password" name="password" placeholder="enter password">
     <button type="submit">log in</button>
     <p><?=  $message ?? "" ?></p>
    </form>
</body>
</html>