<?php 
session_start();
$con = mysqli_connect("sql12.freesqldatabase.com", "sql12530306", "NcCwFRsvdq", "sql12530306");

if (mysqli_connect_errno()) {
  echo "Failed to connect to Database: " . mysqli_connect_error();
}
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    echo $email;
    echo $pass;
    $querySelectAdmin = "SELECT admin_id from Admin where admin_email='$email' and admin_password='$pass'";
    $runQueryGetAdmin = mysqli_query($con, $querySelectAdmin);
    //echo mysqli_num_rows($runQueryGetAdmin);
    if(mysqli_num_rows($runQueryGetAdmin)>0){
         $row = mysqli_fetch_assoc($runQueryGetAdmin);
         $admin_id=$row['admin_id'];
         $_SESSION['admin_id']=$admin_id; 
         $_SESSION['admin_email']=$email;
		 header("location: dashboard.php");
    }
    else{
      echo "Email or password is incorrect, please try again!";
      // header("location: admin_login.php");
    }
