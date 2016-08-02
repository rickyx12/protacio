<?php
include("../../myDatabase.php");
session_start();

$ro = new database();

//unset($_SESSION['username']);
//unset($_SESSION['module']);
unset($_SESSION['employeeID']);
session_destroy();

header("Location: ../../LOGINPAGE/module.php");

?>
