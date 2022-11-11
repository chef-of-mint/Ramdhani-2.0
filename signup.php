<?php 
    session_start();
    include("database/db.php"); 
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];	
    $insert_c = "INSERT into Customer(customer_email,customer_name,customer_password,balance) VALUES ('$c_email','$c_name','$c_pass',0)";

    $run_c = mysqli_query($con, $insert_c); 

    if($run_c){
    $_SESSION['customer_email']=$c_email; 
    echo "<script>alert('Account has been created successfully')</script>";
    //echo "<script>window.open('Home.html')</script>";
    header("location: Home.html");
    }
    else{
        echo "<script>window.alert('Not able to insert')</script>";
        echo "<script>window.open('Login.html')</script>";
        header("location: Login.html");
    }
