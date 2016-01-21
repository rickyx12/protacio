<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$title = $_GET['title'];
$username = $_GET['username'];

$ro = new database2();

$ro->getOPD_title($month,$day,$year,$title,$username);

?>
