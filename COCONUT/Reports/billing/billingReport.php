<?php
include("../../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];


$ro = new database();


echo "<br><center>";
echo "<font size=5>Discharged</font><br>";

$ro->getDischargedPatient($month,$day,$year,$month1,$day1,$year1,"");


?>
