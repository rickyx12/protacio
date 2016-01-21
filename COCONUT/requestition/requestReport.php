<?php
include("../../myDatabase2.php");

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database2();

$mydate = $year."-".$month."-".$day;
$ro->showIssuedRequest($mydate);


?>
