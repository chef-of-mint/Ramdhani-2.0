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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Profile.css">
  <title>Profile</title>

  <script>
    async function myFunction(x) {
      // alert("Row index is: "+x.rowIndex )

      var table = document.getElementById("orders");
      var rows = table.getElementsByTagName("tr");
      var currentRow = table.rows[x.rowIndex];

      var order_id = currentRow.getElementsByTagName("td")[0].innerHTML;
      document.cookie = "order_id" + "=" + order_id;
      var modal = document.getElementById('myModal');
      var span = document.getElementsByClassName("close")[0];
      modal.style.display = "block";
      span.onclick = function() {
        modal.style.display = "none";
      }
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    }
  </script>

</head>

<body>
  <nav id="navbar" class="">
    <div class="nav-wrapper">
      <!-- Navbar Logo -->
      <div class="logo">
        <!-- Logo Placeholder for Inlustration -->
        <a href="Profile.php"><i class="fa fa-angellist"></i> My Profile</a>
      </div>

      <!-- Navbar Links -->
      <ul id="menu">
        <li><a href="Home.html">Home</a></li>
        <!--
   -->
        <li><a href="Home.html#menu_section">Menu</a></li>
        <!--
   -->
        <li><a href="Home.html#about_section">About</a></li>
        <!--
   -->
        <li><a href="Home.html">Logout</a></li>
      </ul>
    </div>
  </nav>


  <!-- Menu Icon -->
  <div class="menuIcon">
    <span class="icon icon-bars"></span>
    <span class="icon icon-bars overlay"></span>
  </div>


  <div class="overlay-menu">
    <ul id="menu">
      <li><a href="#home">Home</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </div>
  <div class="mycontainer">
    <div class="modal">
      <div class="avatar">
        <img src="img/gamer.png" alt="IMAGE" height="110px" width="110px">
      </div>
      <table>
        <tbody>

          <?php
          $queryGetNameBalance = "SELECT customer_name , balance from Customer where customer_email='$user'";
          $runQueryGetNameBalance = mysqli_query($con, $queryGetNameBalance);

          $row = mysqli_fetch_assoc($runQueryGetNameBalance);
          $customer_name = $row['customer_name'];
          $customer_balance = $row['balance'];

          $getCustomerId = "SELECT customer_id FROM Customer WHERE customer_email='$user'";
          $runQueryCid = mysqli_query($con, $getCustomerId);
          $row = mysqli_fetch_assoc($runQueryCid);
          $customer_id = $row['customer_id'];


          echo '<tr>
    <td class="lable">Name </td>
    <td class="invis">abcd</td>
    <td class="value">' . $customer_name . '</td>
</tr>';

          echo '<tr>
<td class="lable">Admission No </td>
<td class="invis">abcd</td>
<td class="value">' . '20JE' . (1000 + 10 * $customer_id) . '</td>
</tr>';

          echo ' <tr>
<td class="lable">Email </td>
<td class="invis">abcd</td>
<td class="value">' . $user . '</td>
</tr>';

          echo '<tr>
<td class="lable">Wallet Balance </td>
<td class="invis">abcd</td>
<td class="value">' . $customer_balance . ' $</td>
</tr>';

          ?>
        </tbody>
      </table>
      <div class="add_button"><button class="button button1">Add Money</button></div>
    </div>
  </div>

  <div class="mycontainer_order">
    <div class="modal">
      <h2>Order List</h2>
      <table id="orders">
        <tbody>

          <tr>
            <td class="lable"><b>Id#</b></td>
            <td class="invis">abcdefghccc</td>
            <td class="value"><b>Date/Time</b></td>
            <td class="invis">abcdefghccc</td>
            <td class="value"><b>Click to view</b></td>
          </tr>
          <?php
          $queryGetOrder = "SELECT order_id,order_date from OrderXCustomer where customer_id='$customer_id'";
          $runQueryGetOrder = mysqli_query($con, $queryGetOrder);
          $i = 0;
          while ($row = mysqli_fetch_assoc($runQueryGetOrder)) {
            $order_id = $row['order_id'];
            $date = $row['order_date'];
            $i++;
            echo '<tr onclick="myFunction(this)">
              <td class="lable">' . $order_id . ' # </td>
              <td class="invis">abcdefghccc</td>
              <td class="value">' . $date . '</td>
              <td class="invis">abcdefghccc</td>
              <td class="value" style="color:blue;cursor:pointer";>View</td>
          </tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  
  <div id="myModal" class="modal_1" style="display:none;">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">×</span>
        <h2>Order Details</h2>
      </div>
      <iframe src="customerOrderDetail.php" height="200" width="300" title="Iframe Example"></iframe>
    </div>
  </div>

</body>

</html>