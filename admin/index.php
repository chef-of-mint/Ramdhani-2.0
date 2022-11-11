<!DOCTYPE html>
<html lang="en">

<head>
   <?php
   session_start();
   $con = mysqli_connect("sql12.freesqldatabase.com", "sql12530306", "NcCwFRsvdq", "sql12530306");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to Database: " . mysqli_connect_error();
   }
   if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_email'])){
      header('location:dashboard.php');
   };
   ?>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>

<body>


   <!-- admin login form section starts  -->

   <section class="form-container">

      <form action="login_script.php" method="POST">
         <h3>login now</h3>
         <input type="text" name="email" maxlength="50" required placeholder="enter your email" class="box">
         <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box">
         <input type="submit" value="login now" name="submit" class="btn">
      </form>

   </section>

   <!-- admin login form section ends -->
</body>

</html>