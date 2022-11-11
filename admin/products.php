<?php

session_start();
$con = mysqli_connect("sql12.freesqldatabase.com", "sql12530306", "NcCwFRsvdq", "sql12530306");

if (mysqli_connect_errno()) {
   echo "Failed to connect to Database: " . mysqli_connect_error();
}

$admin_id = $_SESSION['admin_id'];
$admin_email = $_SESSION['admin_email'];

if (!isset($admin_id)) {
   header('location:index.php');
};

if (isset($_POST['add_product'])) {
   $name = $_POST['name'];
   $price = $_POST['price'];
   $stall = $_POST['category'];
   $url = $_POST['url'];
   $quantity = $_POST['quantity'];

   $queryAddProduct = "INSERT INTO Items (item_name,item_price,stall_id,item_quantity,item_url) VALUES ('$name','$price','$stall','$quantity','$url')";
   $runQueryAddProduct = mysqli_query($con, $queryAddProduct);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>

<body>

<header class="header">

      <section class="flex">

         <a href="dashboard.php" class="logo">Ram<span>Dhani</span></a>

         <nav class="navbar">
            <a href="dashboard.php">Dashboard</a>
            <a href="products.php">Product Management</a>
            <a href="view_customers.php">My customers</a>
            <a href="admin_logout.php">Logout</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas "></div>
         </div>
      </section>

   </header>

   <!-- add products section starts  -->

   <?php

   $stall_id = 1;
   $stall_name = "snacks";

   if ($admin_id == 1) {
      $stall_id = 1;
      $stall_name = "Snacks";
   } else if ($admin_id == 2) {
      $stall_id = 2;
      $stall_name = "Tea";
   } else if ($admin_id == 3) {
      $stall_id = 3;
      $stall_name = "Roll";
   } else {
      $stall_id = 4;
      $stall_name = "Grocery";
   }

   echo '
<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" class="box">
      <input type="number" required placeholder="enter product quantity" name="quantity" maxlength="100" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>select stall --</option>
         <option value=' . $stall_id . '>' . $stall_name . '</option>
      </select>
      <input type="text" name="url" class="box" placeholder="enter image url"  required>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>';

   ?>
   <!-- add products section ends -->

   <!-- show products section starts  -->

   <section class="show-products" style="padding-top: 0;">

      <div class="box-container">

         <?php
         $queryShowProducts = "SELECT * FROM Items";
         $runQueryProducts = mysqli_query($con, $queryShowProducts);

         while ($row = mysqli_fetch_assoc($runQueryProducts)) {
            $item_id = $row['item_id'];
            $item_name = $row['item_name'];
            $item_price = $row['item_price'];
            $stall_id = $row['stall_id'];
            $item_quantity = $row['item_quantity'];
            $item_url = $row['item_url'];

            echo '<div class="box">
         <img src=' . $item_url . ' alt="item">
         <div class="flex">
            <div class="price"><span>$</span>' . $item_price . '<span>/-</span></div>
            <div class="category">Snacks</div>
            <div class="price">' . $item_quantity . '</div>
         </div>
         <div class="name">' . $item_name . '</div>
         <div class="flex-btn">

         <a href="update_product.php?update=' . $item_id . '" class="option-btn">update</a>
         <a href="delete_product.php?delete=' . $item_id . '" class="delete-btn">delete</a>

         </div>
      </div>';
         }
         ?>

      </div>

   </section>

   <!-- show products section ends -->



   <!-- custom js file link  -->
   <script src="admin_script.js"></script>

</body>

</html>