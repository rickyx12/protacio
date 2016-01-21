<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$days = $_GET['days'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$days1 = $_GET['days1'];
$year1 = $_GET['year1'];
$dateSource = $_GET['dateSource'];

$ro = new database2();

$date = $year."-".$month."-".$days;
$date1=$year1."-".$month1."-".$days1;

echo "<font size=2>Source <br> <b>$dateSource</b> <Br> Date Range <Br><b>$date to $date1</b><center><br><br></font>";
$ro->companyPaymentReport($date,$date1,$dateSource);

?>
