<?php 
    session_start();
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "tokoku";

    $koneksi  = mysqli_connect($host, $user, $password, $database);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
</head>
<body>
    <div class="container">
         <div class="header">
         <div class="logo">
             <a href="index.php"><img src="images/1.jpg" alt=""></a>
         </div>
         <div class="judul">
             <h2>tokoku</h2>
         </div>
         <div class="nav">
         <ul>
         <li><a href="?menu=cart">cart</a></li>
         <?php 
         if (!isset ($_SESSION["email"])) {
              ?> 
              <li><a href="?menu=register">register</a></li>
              <li><a href="?menu=login">login</a></li>
              <?php
         } else {
            ?>
            <li><a href="?menu=logout">logout</a></li>
            <li><?= $_SESSION["email"] ?></li>
            <?php 
         }
         ?>
         
         
         </ul>
         </div>
         </div>
         <div class="content">
             <?php 
             if (isset($_GET["menu"])){
                 $menu = $_GET["menu"];
                 if ($menu == "cart"){
                     require_once("pages/cart.php");
                 }
                 if ($menu == "login"){
                     require_once("pages/login.php");
                 }
                 if ($menu == "register"){
                     require_once("pages/register.php");
                 }
                 if ($menu == "logout"){
                     require_once("pages/logout.php");
                 }      
             }else{
                 require_once("pages/product.php");
             }
            ?>
         </div>
         <div class="footer">
             <p>web ini dibuat dengan sesigma mungkin </p>
         </div>
    </div>
</body>
</html>