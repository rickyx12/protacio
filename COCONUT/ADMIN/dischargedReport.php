<?php
include("../../myDatabase.php");
$m = $_GET['month'];
$d = $_GET['day'];
$y = $_GET['year'];
$m1 = $_GET['month1'];
$d1 = $_GET['day1'];
$y1 = $_GET['year1'];
$username = $_GET['username'];
$branchz = $_GET['branchz'];

$ro = new database();

$ro->dischargedReport_admin($m,$d,$y,$m1,$d1,$y1,$username,$branchz);


?>
