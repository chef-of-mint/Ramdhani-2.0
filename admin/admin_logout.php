<?php
session_start();
unset($_SESSION["admin_id"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
unset($_SESSION["admin_email"]);
header("Location: index.php");
?>