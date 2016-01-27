<?php
include("../../myDatabase.php");
session_start();
$branch = $_GET['branch'];
$floor = $_GET['floor'];
$username = $_GET['username'];
$ro = new database();

$_SESSION['username'] = $_GET['username'];
if(!isset($_SESSION['username'])) {
header("Location:/LOGINPAGE/module.php");
}


$ro->showAllRoom($branch,$username,"NURSING",$floor);
?>
