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
  <link rel="stylesheet" href="orderDetails.css" />
  <title>Order Details</title>
</head>

<body>

  <table id="order_details">
    <tr>
      <td><b>Item Name</b></td>
      <td class="spacespace">spacespace</td>
      <td><b>Quantity</b></td>
      <td class="spacespace">spacespace</td>
      <td><b>Price</b></td>
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
                  <td class="spacespace">spacespace</td>
                  <td>' . $order_quantity . '</td>
                  <td class="spacespace">spacespace</td>
                  <td>' . ($item_price) * ($order_quantity) . '</td>
              </tr>
              ';
        $total_price += ($item_price) * ($order_quantity);
      }

      echo '
          <tr>
              <td><b>' . 'Total Price :   ' . '</b></td>
              <td class="spacespace">spacespace</td>
              <td class="spacespace">spacespace</td>
              <td class="spacespace">spacespace</td>
              <td><b>' . $total_price . '</b></td>
          </tr>
          ';
      $total_price += ($item_price) * ($order_quantity);
    } 
    else {
      echo "ERROR Loading!!!";
    }
    ?>
  </table>
</body>
</html>