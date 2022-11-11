<?php


session_start();
$con = mysqli_connect("sql12.freesqldatabase.com", "sql12530306", "NcCwFRsvdq", "sql12530306");

if (mysqli_connect_errno()) {
    echo "Failed to connect to Database: " . mysqli_connect_error();
}

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:index.php');
};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customer</title>

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

    <!-- placed orders section starts  -->

    <section class="placed-orders">

        <h1 class="heading">My Customers : </h1>

        <div class="box-container">

            <?php
            $QueryCustomers = "SELECT * FROM Customer";
            $runQueryCustomers = mysqli_query($con, $QueryCustomers);

            while ($row = mysqli_fetch_assoc($runQueryCustomers)) {
                $customer_name = $row['customer_name'];
                $customer_email = $row['customer_email'];
                $customer_balance = $row['balance'];
                echo '<div class="box">
        <p> Customer Name : <span>' . $customer_name . '</span> </p>
        <p> Customer Email : <span>' . $customer_email . '</span> </p>
        <p> Customer Balance : <span>' . $customer_balance . '</span> </p>
     </div>';
            }
            ?>

        </div>

    </section>

    <!-- placed orders section ends -->









    <!-- custom js file link  -->
    <script src="admin_script.js"></script>

</body>

</html>