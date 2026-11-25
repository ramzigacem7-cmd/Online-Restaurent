<?php 
require "includes/db.php";
session_start();
if(!isset($_SESSION["id"])){
    header("location:login.php");
    exit;
}
$stmt = $pdo->prepare("select * from admin where id_admin=?");
$stmt->execute([$_SESSION["id"]]);
$admin = $stmt->fetch();

$stmt = $pdo->prepare("select * from client;");
$stmt->execute();
$employees = $stmt->fetchAll();

$stmt = $pdo->prepare("select * from category;");
$stmt->execute();
$categories = $stmt->fetchAll();

$stmt = $pdo->prepare("select * from product;");
$stmt->execute();
$products = $stmt->fetchAll();

$stmt = $pdo->prepare("select * from orders;");
$stmt->execute();
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<head>
    <h1>hello <?php echo $admin["name"] ?> you are the admin page</h1>
    
    </head>
    <main>
        <section>
            <div>
            <h2>List of employees:</h2>
            <table border="1" >
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                </tr>
                <?php foreach($employees as $employee):?>
                 <tr>
                    <td><?= $employee["id_client"] ?></td>
                    <td><?= $employee["name"] ?></td>
                    <td><?= $employee["email"] ?></td>
                </tr>
                <?php endforeach; ?>

            </table>
            </div>
               <div>
                <a href="admin_permissions/add_employee.php">add employee</a>
                 <a href="admin_permissions/register.php">Edit employee</a>
                 <a href="admin_permissions/register.php">Delete employee</a>

               </div>
        </section>
         <section>
             <div>
            <h2>List of categories:</h2>
            <table border="1" >
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                </tr>
                <?php foreach($categories as $category):?>
                 <tr>
                    <td><?= $category["category_id"] ?></td>
                    <td><?= $category["name"] ?></td>
                </tr>
                <?php endforeach; ?>

            </table>
            </div>
               <div>
                <a href="admin_permissions/add_category.php">Add category</a>
                 <a href="admin_permissions/register.php">Edit category</a>
                 <a href="admin_permissions/register.php">Delete category</a>

               </div>
         </section>
          <section>
             <div>
            <h2>List of products:</h2>
            <table border="1" >
                <tr>
                    <th>PRODUCT ID</th>
                    <th>CATEGORY ID</th>
                    <th>PRODUCT NAME</th>
                    <th>PRODUCT PRICE</th>
                </tr>
                <?php foreach($products as $product):?>
                 <tr>
                    <td><?= $product["product_id"] ?></td>
                    <td><?= $product["category_id"] ?></td>
                    <td><?= $product["name"] ?></td>
                    <td><?= $product["price"] ?> DA</td>
                </tr>
                <?php endforeach; ?>

            </table>
            </div>
               <div>
                 <a href="admin_permissions/add_product.php">Add product</a>
                 <a href="admin_permissions/register.php">Edit product</a>
                 <a href="admin_permissions/register.php">Delete product</a>

               </div>
          </section>
          <section>
             <div>
            <h2>List of Orders:</h2>
            <table border="1" >
                <tr>
                    <th>ORDER ID</th>
                    <th>ORDER DATE</th>
                    <th>ORDER STATUS</th>
                    <th>COSTUMER NAME</th>
                    <th>COSTUMER PHONE</th>
                     <th>COSTUMER ADDRESS</th>
                      <th>COSTUMER NOTE</th>
                       <th>TOTAL PRICE</th>

                    
                </tr>
                <?php foreach($orders as $order):?>
                 <tr>
                    <td><?= $order["order_id"] ?></td>
                    <td><?= $order["order_date"] ?></td>
                    <td><?= $order["status"] ?></td>
                    <td><?= $order["customer_name"] ?></td>
                    <td><?= $order["phone"] ?></td>
                   <td><?= $order["address"] ?></td>
                   <td><?= $order["notes"] ?></td>
                   <td><?= $order["total_price"] ?></td>
                </tr>
                <?php endforeach; ?>

            </table>
            </div>
               <div>
                 <a href="admin_permissions/register.php">Edit product</a>
                 <a href="admin_permissions/register.php">Delete product</a>

               </div>
          </section>

    </main>
    <footer>
         <a href="logout.php">logout</a>
    </footer>

</body>
</html>