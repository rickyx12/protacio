<?php
include("../../../myDatabase.php");
$doctor = $_GET['doctor'];
$username = $_GET['username'];
$module = $_GET['module'];

$m = $_GET['month'];
$d = $_GET['day'];
$y = $_GET['year'];
$m1 = $_GET['month1'];
$d1 = $_GET['day1'];
$y1 = $_GET['year1'];
$ro = new database();

$ro->doctorDischargedReport($m,$d,$y,$m1,$d1,$y1,$doctor,"IPD",$username);

?>
