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

if (isset($_POST['update'])) {

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $url = $_POST['url'];

    $stall_id = 1;


    if ($category == "Snacks") {
        $stall_id = 1;
    } else if ($category == "Tea") {
        $stall_id = 2;
    } else if ($category == "Roll") {
        $stall_id = 3;
    } else {
        $stall_id = 4;
    }

    $queryUpdateProduct = "UPDATE Items set item_name='$name' , item_price='$price' , stall_id='$stall_id',item_quantity='$quantity' , item_url = '$url' where item_id = '$pid'";
    mysqli_query($con, $queryUpdateProduct);

    $message[] = 'product updated!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update product</title>

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

    <!-- update product section starts  -->

    <section class="update-product">

        <h1 class="heading">update product</h1>

        <?php
        $update_id = $_GET['update'];
        $queryGetItemDetails = "SELECT item_name,item_price,stall_id,item_quantity,item_url from Items where item_id='$update_id'";
        $runQueryGetItemDetails = mysqli_query($con, $queryGetItemDetails);
        $row = mysqli_fetch_assoc($runQueryGetItemDetails);
        $update_name = $row['item_name'];
        $update_item_price = $row['item_price'];
        $update_stall_id = $row['stall_id'];
        $update_item_quantity = $row['item_quantity'];
        $update_item_url = $row['item_url'];

        $update_stall_name = "snacks";
        if ($update_stall_id == 1) {
            $update_stall_name = "Snacks";
        } else if ($update_stall_id == 2) {
            $update_stall_name = "Tea";
        } else if ($update_stall_id == 3) {
            $update_stall_name = "Roll";
        } else {
            $update_stall_name = "Grocery";
        }

        echo '
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value=' . $update_id . '>
      <input type="hidden" name="old_image" value=' . $update_item_url . '>
      <img src=' . $update_item_url . ' alt="procuct image">
      <span>update name</span>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value=' . $update_name . '>
      <span>update price</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price"  class="box" value=' . $update_item_price . '>
      <span>update quantity</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter product quantity" name="quantity"  class="box" value=' . $update_item_quantity . '>
      <span>update category</span>
      <select name="category" class="box" required>
         <option selected value=' . $update_stall_name . '>' . $update_stall_name . '</option>
         <option value="Snacks">Snacks</option>
         <option value="Tea">Tea</option>
         <option value="Roll">Roll</option>
         <option value="Grocery">Grocery</option>
      </select>

      <span>update image</span>

      <input type="text" name="url" class="box" placeholder="enter image url" value=' . $update_item_url . ' required>

      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="products.php" class="option-btn">go back</a>
      </div>
   </form>
</section>';

        ?>

        <!-- update product section ends -->




        <!-- custom js file link  -->
        <script src="admin_script.js"></script>

</body>

</html>