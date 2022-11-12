<?php
ob_start();
  session_start();
  $con = mysqli_connect("sql12.freesqldatabase.com","sql12530306","NcCwFRsvdq","sql12530306");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to Database: " . mysqli_connect_error();
  }
  if (!isset($_SESSION['customer_email'])) {
    header("location: customer_login.php");
  }
  $user = $_SESSION['customer_email'];
//email=abdullah%40gmail.com&psw=abdullah&amnt=10
  //echo $_GET['amnt'];
  $getCustomerId = "SELECT customer_id FROM Customer WHERE customer_email='$user'";
        $runQueryCid = mysqli_query($con, $getCustomerId);
        $row = mysqli_fetch_assoc($runQueryCid);
        $customer_id = $row['customer_id'];
    $getBalance = "SELECT balance FROM Customer WHERE customer_email='$user'";
        $runQueryBal = mysqli_query($con, $getBalance);
        $rowi = mysqli_fetch_assoc($runQueryBal);
        $balance = $rowi['balance'];
        $balance = $balance + $_GET['amnt'];
    $alterWallet = "UPDATE Customer SET balance = $balance WHERE customer_email='$user'";
        $runQueryAlter = mysqli_query($con, $alterWallet);
        //$row = mysqli_fetch_assoc($runQueryAlter);
    //echo $balance;
header("location: Profile.php");
ob_end_flush();
exit;
  
?>