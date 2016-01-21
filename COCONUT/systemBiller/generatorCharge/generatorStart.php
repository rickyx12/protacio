<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database2();

$date = $year."-".$month."-".$day;

$ro->insertGeneratorLog($date,date("H:i:s"),"","","on",$username);

header("Location: /COCONUT/systemBiller/generatorCharge/showList.php?username=$username&month=$month&day=$day&year=$year&username=$username");

?>
