<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

   <?php
   session_start();
   $con = mysqli_connect("sql12.freesqldatabase.com", "sql12530306", "NcCwFRsvdq", "sql12530306");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to Database: " . mysqli_connect_error();
   }
   ?>

   <?php

   if (!isset($_SESSION['admin_id'])) {
      header("location: index.php");
   }
   $admin_id = $_SESSION['admin_id'];
   $admin_email = $_SESSION['admin_email'];
   ?>
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

   <!-- admin dashboard section starts  -->


   <section class="dashboard">

      <h1 class="heading">dashboard</h1>

      <div class="box-container">

         <div class="box">
            <h3>welcome!</h3>
            <?php
            if ($admin_id == 1) {
               echo "<p>Hello Snacks Admin !!</p>";
            } else if ($admin_id == 2) {
               echo "<p>hello Tea Admin !!</p>";
            } else if ($admin_id == 3) {
               echo "<p>Hello Rolls Admin !!</p>";
            } else {
               echo "<p>Hello Grocery Admin !!</p>";
            }
            ?>
            <a href="products.php" class="btn">Add/Update Products</a>
            <a href="view_customers.php" class="btn">My Customers</a>
         </div>

      </div>

   </section>

   <!-- admin dashboard section ends -->


   <!-- custom js file link  -->
   <script src="admin_script.js"></script>

</body>

</html>