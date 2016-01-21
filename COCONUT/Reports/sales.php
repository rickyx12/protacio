<?php
include("../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$module = $_GET['module'];
$username = $_GET['username'];
$type = $_GET['type'];

$ro = new database();

echo "Sales Report";
echo "<Br>";
echo $year."-".$month."-".$day." to ".$year1."-".$month1."-".$day1;
echo "<br>";
echo $type;
echo "<br><br>";

$ro->getSalesReport($month,$day,$year,$month1,$day1,$year1,$username,$module,$type);




?>
