<?php 

require_once __DIR__ . "/../includes/db.php";
if($_SERVER["REQUEST_METHOD"] === "POST")
$name = filter_input(INPUT_POST,"name");
$email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST,"password");
if(empty($name)){
    echo "enter name";
}else if(!isset($email)){
echo "enter email";
}else if(strlen("password") < 8){
 echo "password should be at least 8 charecters";
}else{
    $hashed_pass = password_hash($password,PASSWORD_DEFAULT);

try{
    $id_admin = 1;
$stmt = $pdo->prepare("insert into employee (id_admin,name,email,password) values(?,?,?,?)");
$stmt->execute([$id_admin,$name,$email,$hashed_pass]);
echo "registerd succesful";
}catch(PDOException $e){
 $e->getMessage();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>
    <a href="login.php">log in</a>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="enter name" >
          <input type="email" name="email" placeholder="enter email">
            <input type="password" name="password" placeholder="enter password">
            <button type="submit">sign up</button>
    </form>
    
</body>
</html>