<?php
include("../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$username = $_GET['username'];


$ro = new database();

$ro->expiration($month,$day,$year,$month1,$day1,$year1,$username);

?>
