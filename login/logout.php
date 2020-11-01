<?php
session_start();
unset($_SESSION["loggedin"]);
unset($_SESSION["SESS_MEMBER_ID"]);
unset($_SESSION["username"]);
header("Location:login.php");
?>