<?php
session_start();
$con = mysqli_connect("sql12.freesqldatabase.com", "sql12530306", "NcCwFRsvdq", "sql12530306");

if (mysqli_connect_errno()) {
  echo "Failed to connect to Database: " . mysqli_connect_error();
}
$delete_id = $_GET['delete'];
//echo $delete_id;
 $queryDeleteItem= "DELETE FROM Items where item_id='$delete_id' ";
 mysqli_query($con,$queryDeleteItem);
 header('location:products.php');
