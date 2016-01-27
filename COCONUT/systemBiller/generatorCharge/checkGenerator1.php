<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();


$ro->checkGenerator($month,$day,$year,$month1,$day1,$year1,$registrationNo,$username);


?>
