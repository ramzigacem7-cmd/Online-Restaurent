<?php
require_once __DIR__ . "/../includes/db.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $category_id = filter_input(INPUT_POST,"category_id");
    $name = filter_input(INPUT_POST,"name");
    $price = filter_input(INPUT_POST,"price");
    $image = filter_input(INPUT_POST,"image");
    if(empty($category_id)){
        echo "enter category id";
    }else if(empty($name)){
        echo "enter product name";
    }else if(empty($price)){
        echo "enter price";
    }else if(empty($image)){
        echo "enter image path";
    }else{
        try{
         $stmt = $pdo->prepare("insert into product (category_id,name,price,image) values (?,?,?,?);");
         $stmt->execute([$category_id,$name,$price,$image]);
         echo "succesefully";
        }catch(PDOException $e){
            $e->getMessage();
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
    <link rel="stylesheet" href="add.css">
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="category_id" placeholder="enter category ID">
        <input type="text" name="name" placeholder="enter product name" >
        <input type="number" name="price" placeholder="enter product price">
        <input type="text" name="image" placeholder="enter image path">
        <button type="submit">Add</button>
    </form>
</body>
</html>