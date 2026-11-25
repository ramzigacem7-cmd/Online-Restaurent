<?php 
require_once __DIR__. "/../includes/db.php";
$category_id = $_GET["category_id"];
if($category_id == null){
    header("location:employee.php");
    exit;
}

$stmt = $pdo->prepare("select * from product where category_id =?");
$stmt->execute([$category_id]);
$products = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="category.css">
</head>
<body>
    <main>
        <section>
            <?php foreach($products as $product): ?>
             <article>
                
                <img src="<?= $product["image"] ?>" alt="product_image">
                <h3><?= $product["name"] ?></h3>
                 <p>Price: <span> <?= $product["price"] ?> </span><strong style="color:green"> DA</strong></p>
                   <button type="submit" class="add_btn"  data-id="<?= $product['product_id'] ?>">Add to Cart</button>
            </article>
             <?php endforeach; ?>
            </section>
    </main>
    <script src="category.js"></script>
</body>
</html>