<?php
include("../../myDatabase.php");

session_start();

$ro = new database();

if ( (!isset($_SESSION['username']) && !isset($_SESSION['module'])) ) {
header("Location:/LOGINPAGE/module.php");
}

unset($_SESSION['username']);
unset($_SESSION['module']);
session_destroy();
header("Location:/LOGINPAGE/module.php");
die();

?>
