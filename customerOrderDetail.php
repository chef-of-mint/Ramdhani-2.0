<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  session_start();
  include("database/db.php");

  if (!isset($_SESSION['customer_email'])) {
    header("location: customer_login.php");
  }
  $user = $_SESSION['customer_email'];
  ?>

  <meta charset="UTF-8">
  <link rel="stylesheet" href="Profile.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
  <title>Order Details</title>
</head>

<body>

  <table id="order_details">
    <tr>
      <th>Item Name</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>

    <?php
    $getCustomerId = "SELECT customer_id FROM Customer WHERE customer_email='$user'";
    $runQueryCid = mysqli_query($con, $getCustomerId);
    $row = mysqli_fetch_assoc($runQueryCid);
    $customer_id = $row['customer_id'];


    if (isset($_COOKIE["order_id"])) {
      $order_id = $_COOKIE["order_id"];
      $getOrderDetails = "SELECT I.item_name as item_name,O.order_quantity as order_quantity,I.item_price as item_price from Items I,OrderXItems O where O.item_id=I.item_id and O.order_id=$order_id";
      $runOrderDetails = mysqli_query($con, $getOrderDetails);
      $i = 0;
      $total_price = 0;
      while ($row = mysqli_fetch_assoc($runOrderDetails)) {
        $item_name = $row['item_name'];
        $item_price = $row['item_price'];

        $order_quantity = $row['order_quantity'];
        $i++;
        echo '
              <tr>
                  <td>' . $item_name . '</td>
                  <td>' . $order_quantity . '</td>
                  <td>' . ($item_price) * ($order_quantity) . '</td>
              </tr>
              ';
        $total_price += ($item_price) * ($order_quantity);
      }

      echo '
          <tr>
              <th>' . 'Total Price : ' . '</td>
              <th>' . '' . '</td>
              <th>' . $total_price . '</td>
          </tr>
          ';
      $total_price += ($item_price) * ($order_quantity);
    } 
    else {
      echo "error loading";
    }
    ?>
  </table>
</body>
</html>