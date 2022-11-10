<?php
session_start();
unset($_SESSION["customer_email"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
header("Location: Login.html");
?>