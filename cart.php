<?php
 require_once "includes/db.php";
  $error = "";
 $show_form = "none";
 $value = "";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $f_name = filter_input(INPUT_POST,"full_name");
    $phone =  filter_input(INPUT_POST,"phone_number");
     $address =  filter_input(INPUT_POST,"address");
      $note =  filter_input(INPUT_POST,"note");
       $items_json = $_POST["cart_data"] ?? "";
      $items = json_decode($items_json,true);
      if(empty($f_name) || empty($phone) || empty($address)){
         $show_form = "block";
          $error = "Please fill in all required fields.";
      }else{
        try{
        $stmt = $pdo->prepare("insert into orders(status,customer_name,phone,address,notes) values(?,?,?,?,?)");
        $stmt->execute(["pending",$f_name,$phone,$address,$note]);
        $order_id = $pdo->lastInsertId();
         $stmt = $pdo->prepare("insert into order_item(order_id,product_id,quantity) values(?,?,?);");
         foreach($items as $item){
         $stmt->execute([$order_id,$item["product_id"],$item["quantity"]]);
         }
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
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="cart">
    <h1>Your Cart</h1>
    <p>Review your delicious choices before checkout</p>
    <div class="items">

</div>
  <hr>
    <div class="total">
            <h3>Total:</h3>
            <h2><span class="total_price">0</span> DA</h2>
        </div>
        <button class="check_btn">Proceed to Checkout →</button>
        <br>
        <br>
        <a href="main_page.php">Continue Shopping</a>
        </div>
     <form    method="POST"  action="cart.php" style="display: <?= $show_form ?>;">
        <h2>Checkout</h2>
        <p>Please enter your information to complete your order</p>
        <h3>Personal Information</h3>
        <label for="full_name">Full Name:
        <input type="text" id="full_name" name="full_name" value="<?= $value?>" placeholder="Enter your name">
        </label>
         <small class="name_error" style="color: red;"></small> 
        <hr>
        <label for="phone_number">Phone Number:
        <input type="text"  id="phone_number"  name="phone_number" value="<?= $value?>" placeholder="Enter your phone number">
        </label>
         <small class="phone_error" style="color: red;"></small> 
        <hr>
        <label for="address">Delivery Address:
        <input type="text" id="address" name="address" value="<?= $value ?>"  placeholder="Enter your address">
        </label>
         <small class="address_error" style="color: red;"></small> 
        <hr>
        <label for="note">Additional Notes (Optional):
        <input type="text" id="note" name="note" value="<?= $value?>" placeholder="Any special instructions">
        </label>
        <hr>
        <p style="color: red;"><?= $error ?></p>
       <div class="total">
            <h3>Total:</h3>
            <h2><span class="total_price">0</span> DA</h2>
        </div>
        <input type="hidden" name="cart_data" id="cart_data">

        <button  type="submit" class="confirm_btn"  >Place Order</button>
 
     </form>


    <script src="cart.js"></script>
</body>

</html>


