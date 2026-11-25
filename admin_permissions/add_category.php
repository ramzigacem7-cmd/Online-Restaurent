<?php 
require_once __DIR__ . "/../includes/db.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name =  filter_input(INPUT_POST,"name");
    $image =  filter_input(INPUT_POST,"image");
    $link =  filter_input(INPUT_POST,"link");
    if(empty($name)){
        echo "enter name";
    }else
    if(empty($image)){
        echo "enter image path";
    }else
    if(empty($link))
    {
        echo "enter category link";
    }   
    
    else{
        try{
       $stmt = $pdo->prepare("insert into category(name,image,link) values (?,?,?);");
        $stmt->execute([$name,$image,$link]);
        }catch(PDOException $e){
           $e->getMessage();
        };
       
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
    <form action="" method="POST">
        <input type="text" name="name" placeholder="enter category name">
                <input type="text" name="image" placeholder="enter image path">
        <input type="text" name="link" placeholder="enter category link ">

        <button type="submit">Add</button>
    </form>
</body>
</html>