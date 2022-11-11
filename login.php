<?php 
		session_start();
		include("database/db.php");
		// if(isset($_POST['Login'])){
		// }

        $c_mail = $_POST['email'];
			$c_pass = $_POST['pass'];
			
			$sel_c = "SELECT * from Customer where customer_password='$c_pass' AND customer_email='$c_mail'";
			
			$run_c = mysqli_query($con, $sel_c);
			
			$check_customer = mysqli_num_rows($run_c); 

            //echo $check_customer;
			if($check_customer>0 ){
			$_SESSION['customer_email']=$c_mail; 
			header("location: Home.html");
			}	
            else{
                echo "<script>alert('Email or password is incorrect, please try again!')</script>";
                // header("location: Login.html");
            }
