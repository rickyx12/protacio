<?php
include("../../../myDatabase.php");
session_start();
$username = $_GET['username'];
$branch = $_GET['branch'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];


$ro = new database();

if(!isset($_SESSION['username'])) {
header("Location:/LOGINPAGE/module.php");
}

echo "<br><center>";
echo "<font size=5>Discharged Report</font><br>";
echo "<font size=3>($branch)</font><br>";

$ro->getDischargedPatient($month,$day,$year,$month1,$day1,$year1,$branch);


?>
