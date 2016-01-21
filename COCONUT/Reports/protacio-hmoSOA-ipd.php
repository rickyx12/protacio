<?php
include("../../myDatabase2.php");

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$company = $_GET['company'];

$ro = new database2();


echo "<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/ProtacioHeader.png' width='100%' height='150px'>";
echo "<br><br><br>";
echo "<font color='green'>TO:</font>&nbsp;<font color='blue'>".$company."</font>";
echo "<br>";
echo "<font color='green'>FR:&nbsp;PROTACIO HOSPITAL</font>";
echo "<br><br>";
$ro->protacio_hmoSOA_ipd($company,$year."-".$month."-".$day,$year1."-".$month1."-".$day1);
echo "<br><Br>";


?>
