<?php 
 
require "includes/db.php";
session_start();

$stmt = $pdo->prepare("select * from category;");
$stmt->execute();
$categories = $stmt->fetchAll();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = filter_input(INPUT_POST,"name");
     $email= filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
      $message = filter_input(INPUT_POST,"message");
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main_page.css">
</head>
<body>
    <head>
        <nav>
             <img class="logo" src="images/ca3b245f-35a9-4560-9eb9-68dbe36fe40c.png" alt="restaurant logo">
             <div class="sections">
          <a href="#home_page" class="link">Home</a>
           <a href="#menu_page"  class="link">Menu</a>
            <a href="#about_page"  class="link">About Us</a>
             <a href="#contact_page"  class="link">Contact</a>
        </div>
        <a href="cart.php" class="cart">Cart</a>
        </nav>
    </head>
    <main>
        <section class="home_section" id="home_page">
          
            <h1 class ="title">Castle Wood Pizza</h1>
        <img src="images/489880080_1210869601049641_552742814981713568_n.jpg" alt="restaurant image" class="home_image">
        </section>
         <section class="menu_section" id="menu_page">
             <br><br><br><br><br><br><br>
             <?php foreach($categories as $category): ?>
                <article>
         <a href="<?= $category["link"]?>?category_id=<?=$category["category_id"] ?> " class="links">
         <img src="<?= $category["image"] ?>" alt="">
         </a>
         <div class="name_description">
         <h1><?= $category["name"] ?></h1>
         <p><?= $category["description"] ?></p>
         </div>
         </article>
         <?php endforeach;?>
        </section>
         <section class="about_section" id="about_page">
          <img src="images/470017901_1063670318832724_2870538645974254827_n.jpg" alt="restaurent image">
          <div>
            <h2> About Castle Wood Pizza</h2>
           <p>"At Castle Wood Pizza, we believe that great food brings people together. We are passionate about preparing delicious meals using quality ingredients and fresh flavors. Our goal is to provide every customer with a wonderful food experience."
</p>
          </div>
        </section>
     <section class="contact_section" id="contact_page">
        <div>
            <img class="restaurent_img" src="images/Screenshot 2026-10-31 224659.png" alt="restaurant photo">
<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d51174.21852818851!2d3.1830836193685044!3d36.71322597605609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sCastel%20Wood%20pizza!5e0!3m2!1sen!2sdz!4v1793484677792!5m2!1sen!2sdz"  style="border:0;"  loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
</div>
          <div class="contact_info">
              <h2>Get In Touch</h2>
              <br>
              <p>we'd love to hear from you</p>
              <br>
              <h3>Dar El Beida, Algeria</h3>
              <br>
              <h3>Restaurant phone number</h3>
              <br>
              <h3>Instagram</h3>
              <br>
              <hr width="600">
              <br>
              <h2>Send Us a message</h2>
              <br>
              <form class="message_form" action="" method="POST">
                <input type="text" name="name" placeholder="Your Name">
                 <input type="text" name="email" placeholder="Your Email">
                  <input type="text" name="message" placeholder="Your Message">
                 
                  <button type="submit">Send message</button>
              </form>
        </div>
        </section>
    </main>

    <footer>
      <h2>CASTLE WOOD PIZZA</h2>
      <P>Delicious nonents,unforgettabel taste</P>
      <hr width="500">
      <div class="first_div">
        <div class="second_div">
            <h3>Follow Us</h3>
            <br>
            <p>Instagram</p>
            <p>Facebook</p>
            <p>TikTok</p>
        </div>
        <div class="second_div">
            <h3>Explore</h3>
            <br>
             <a href="#home_page">Home</a>
           <a href="#menu_page" >Menu</a>
            <a href="#about_page" >About Us</a>
             <a href="#contact_page" >Contact</a>
        </div>
      </div >
      <hr width="500">
      &copy; 2026Castle Wood Pizza. All Rights reserved.

        
    </footer>
   <script src="main_page.js"></script>
</body>
</html>