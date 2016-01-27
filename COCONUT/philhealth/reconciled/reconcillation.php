<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$type = $_GET['type'];

$ro = new database2();

$ro->phic_reconcillation_acct($month,$day,$year,$month1,$day1,$year1,$type);


?>
