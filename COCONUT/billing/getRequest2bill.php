<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$username = $_GET['username'];
$ro = new database2();

$datez = $year."-".$month."-".$day;

$ro->getRequest2bill($datez,$username);

?>
