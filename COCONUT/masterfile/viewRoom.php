<?php
include("../../myDatabase.php");
session_start();
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$ro = new database();

if(!isset($_SESSION['username']) ) {
header("Location:/LOGINPAGE/module.php");
}

$ro->getMasterListRoom($username,$show,$desc);

?>
