<!DOCTYPE html>
<html lang="en">

<head>
<script>
    let params = new URLSearchParams(location.search);
    if(params.get('state')=="Success"){
      alert("Ordered Successfully");
      var newURL = location.href.split("?")[0];
      window.history.pushState('object', document.title, newURL);
    }
    var my_id=[];
    const ids = new Set();

    // empty cookie
    myarray=Array.from(ids).join(',');
    document.cookie = "my_cookie="+JSON.stringify(myarray);

    
    function myfunc(btn){
      document.getElementsByClassName("bottom")[btn.id].classList.add("clicked");
      var item_id = document.getElementsByClassName("chupao")[btn.id].innerHTML;
      // alert(item_id+" "+btn.id);
      ids.add(item_id);
      my_id = Array.from(ids).join(',');
      document.cookie = "my_cookie="+JSON.stringify(my_id);
    }
    function myremove(btn){
      document.getElementsByClassName("bottom")[(btn.id)].classList.remove("clicked");
      //alert(btn.id/100);
      var item_id = document.getElementsByClassName("chupao")[btn.id].innerHTML;
      ids.delete(item_id);
      //ids.delete(btn.id);
      my_id = Array.from(ids).join(',');
      document.cookie = "my_cookie="+JSON.stringify(my_id);
    }
  </script>
  <?php
  session_start();
  $con = mysqli_connect("sql12.freesqldatabase.com", "sql12530306", "NcCwFRsvdq", "sql12530306");

  if (mysqli_connect_errno()) {
    echo "Failed to connect to Database: " . mysqli_connect_error();
  }

  if (!isset($_SESSION['customer_email'])) {
    header("location: ../Login.html");
  }
  $user = $_SESSION['customer_email'];
  ?>

  
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="items.css">
  <title>Ramdhani</title>
</head>

<body>

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <nav id="navbar" class="">
    <div class="nav-wrapper">
      <!-- Navbar Logo -->
      <div class="logo">
        <!-- Logo Placeholder for Inlustration -->
        <a href="/Profile.html">Items Menu</a>
      </div>

      <!-- Navbar Links -->
      <ul id="menu">
        <li><a href="../Home.html">Home</a></li>
        <!--
   -->
        <li><a href="../Home.html#menu_section">Menu</a></li>
        <!--
   -->
        <li><a href="../Home.html#about_section">About</a></li>
        <!--
   -->
        <li><a href="../logout.php">Logout</a></li>
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

  <div class="item_grid">

    <?php
    $queryGetGrocery = "SELECT item_id,item_name,item_price,item_url from Items where stall_id=2";
    $runQueryGetGrocery = mysqli_query($con, $queryGetGrocery);
    $i = 0;
    while ($row = mysqli_fetch_assoc($runQueryGetGrocery)) {
      $item_id = $row['item_id'];
      $item_name = $row['item_name'];
      $item_price = $row['item_price'];
      $item_url = $row['item_url'];
      echo '
      <div class="wrapper">
        <div class="container">
          <div class="top" style="background:url(' . $item_url . ') no-repeat center center;"></div>
          <div class="bottom">
            <div class="left">
              <div class="details">
                <h3>' . $item_name . '</h3>
                <p>₹' . $item_price . '</p>
                <p class="chupao">'.$item_id.'</p>
              </div>
              <div class="buy" id="'.$i.'" onclick="myfunc(this)" class="clicked"><i class="material-icons">add_shopping_cart</i></div>
            </div>
            <div class="right">
              <div class="done"><i class="material-icons">done</i></div>
              <div class="details">
                <h3>' . $item_name . '</h3>
                <p>Added to your cart</p>
              </div>
              <div id="'.$i.'" class="remove" onclick="myremove(this)"><i class="material-icons">clear</i></div>
            </div>
          </div>
        </div>
        <div class="inside">
          <div class="icon"><i class="material-icons">info_outline</i></div>
          <div class="contents">
            <table>
            <tr>
              <th><b>Name</b></th>
              <th><b>Price</b></th>
            </tr>
            <tr>
              
              <td>' . $item_name . '</td>
              <td>' . $item_price . '</td>
              </tr>
            </table>
          </div>
        </div>
      </div>';
      $i++;
    }
    ?>
  </div>
  
  <div class="order_button"><form action="place_order.php" method="post"><input class="button button1" name="btn-po" type="submit" value="Place Order"></form></div>
</body>

</html>